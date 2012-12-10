
/* Multiplicación de matrices: P = M * N.
 * código Host.
 */

// includes, system
#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <math.h>

// includes, project
#include <cutil.h>

// includes, kernels
#include "matrixmul_kernel.cu"

#include "assist.h"

#define ERROR_CHECK { cudaError_t err; \
  if ((err = cudaGetLastError()) != cudaSuccess) { \
    printf("CUDA error: %s, line %d\n", cudaGetErrorString(err), __LINE__);}}

////////////////////////////////////////////////////////////////////////////////
// declaration, forward
void runTest(int argc, char** argv);

////////////////////////////////////////////////////////////////////////////////
// Program main
////////////////////////////////////////////////////////////////////////////////
int
main(int argc, char** argv)
{
    runTest(argc, argv);
}

////////////////////////////////////////////////////////////////////////////////
//! Run a simple test for CUDA
////////////////////////////////////////////////////////////////////////////////
void
runTest(int argc, char** argv)
{
    bool if_quiet = true;
    unsigned int timer_compute = 0;
    unsigned int timer_memory = 0;
    int i, j;
    char *matrix_id = NULL, *input_fn = NULL, *gold_fn = NULL;
    float * deviceM = NULL, * deviceN = NULL, * deviceP = NULL;
    int Mw = 0, Mh = 0, Nw = 0, Nh = 0, Pw = 0, Ph = 0;
    int block_size = 0;

    if (argc == 2) {
        matrix_id = strdup(argv[1]);

    } else {
        fprintf(stderr, "Error: Wrong input parameter numbers.\n");
        fprintf(stderr, "Usage:\n"
                        "$> ./lab2-matrixmul <8, 128, 512, 3072, 4096>\n"
                        "Examples:\n"
                        "      $> ./lab2-matrixmul 128\n"
                        );
        exit(1);
    }

    // Nota: Las tamaños de la matriz (width-ancho y height-alto) deben ser múltiplos del tamaño de bloque.
    if (!strcmp(matrix_id, "8")) {
        Mw = Mh = Nw = Nh = Pw = Ph = 8;
        block_size = 2; // numero de threads por bloque = block_size^2
        input_fn = strdup("matrix_8.bin");
        gold_fn = strdup("matrix_8.gold");
        if_quiet = false; // If not display matrix contents
    } else
    if (!strcmp(matrix_id, "128")) {
        Mw = Mh = Nw = Nh = Pw = Ph = 128;
        block_size = 16; // numero de threads por bloque = block_size^2
        input_fn = strdup("matrix_128.bin");
        gold_fn = strdup("matrix_128.gold");
        if_quiet = true; // If not display matrix contents
    } else
    if (!strcmp(matrix_id, "512")) {
        Mw = Mh = Nw = Nh = Pw = Ph = 512;
        block_size = 16; // numero de threads por bloque = block_size^2
        input_fn = strdup("matrix_512.bin");
        gold_fn = strdup("matrix_512.gold");
        if_quiet = true; // If not display matrix contents
    } else
    if (!strcmp(matrix_id, "3072")) {
        Mw = Mh = Nw = Nh = Pw = Ph = 3072;
        block_size = 16; // numero de threads por bloque = block_size^2
        input_fn = strdup("matrix_3072.bin");
        gold_fn = strdup("matrix_3072.gold");
        if_quiet = true; // If not display matrix contents
    } else
    if (!strcmp(matrix_id, "4096")) {
        Mw = Mh = Nw = Nh = Pw = Ph = 4096;
        block_size = 32; // numero de threads por bloque = block_size^2
        input_fn = strdup("matrix_4096.bin");
        gold_fn = strdup("matrix_4096.gold");
        if_quiet = true; // If not display matrix contents
    } else {
        printf("***Error en %s: %d: ID de la matriz no definido.\n",
            __FILE__, __LINE__);
        printf("   Deberías añadirlo al código fuente.\n");
        printf("   Valores actuales son 8, 128, 512, 3072, 4096.\n");
        exit(1);
    }

    printf("Nombre del fichero de entrada de matrices: %s\n", input_fn);

    // -----------------------------------------------------------------------
    // Setup host side
    // -----------------------------------------------------------------------

    int rc = GenMatrixFile(input_fn, Mw, Mh, if_quiet);
	
    printf("Preparacion de la parte host y lanzamiento del kernel:\n");

    // Reserva de memoria host para matrices M y N
    printf("  Reserva de memoria host para matrices M y N.\n");
    printf("    M: %d x %d\n", Mw, Mh);
    printf("    N: %d x %d\n", Nw, Nh);
    unsigned int size_M = Mw * Mh;
    unsigned int mem_size_M = sizeof(float) * size_M;
    float* hostM = (float*) malloc(mem_size_M);
    unsigned int size_N = Nw * (Nh);
    unsigned int mem_size_N = sizeof(float) * size_N;
    float* hostN = (float*) malloc(mem_size_N);

    // Reserva de memoria para resultados en el host
    printf("  Reserva de memoria para el resultado en la parte host.\n");
    unsigned int size_P = Pw * Ph;
    unsigned int mem_size_P = sizeof(float) * size_P;
    float* hostP = (float*) malloc(mem_size_P);

    // Initialize the input matrices.
    printf("  Inicializa las matrices de entrada.\n");
    unsigned int * matrix = ReadMatrixFile(input_fn, Pw, Ph, if_quiet);
    for (i = 0; i < Mw; i++)
        for (j = 0; j < Nw; j++)
	        hostM[i * Mw + j] = hostN[i * Mw + j] = (float) matrix[i*Mw + j];
    
    free(matrix); 
    matrix = NULL;

    // ===================================================================
    //  Parte 1 de la solución:
    //  Reservar device memory para las matrices de entrada.
    //  Copiar memoria desde el host a la device.
    // ===================================================================  

    CUT_SAFE_CALL(cutCreateTimer(&timer_memory));
    CUT_SAFE_CALL(cutStartTimer(timer_memory));

    printf("  Reservar memoria device.\n");
    CUDA_SAFE_CALL(cudaMalloc((void **) &deviceM, mem_size_M ));
    CUDA_SAFE_CALL(cudaMalloc((void **) &deviceN, mem_size_N ));

    printf("  Copiar host memory al device.\n");
    CUDA_SAFE_CALL(cudaMemcpy(deviceM, hostM, mem_size_M, cudaMemcpyHostToDevice ));
    CUDA_SAFE_CALL(cudaMemcpy(deviceN, hostN, mem_size_N, cudaMemcpyHostToDevice ));

    printf("  Reservar device memory para los resultados.\n");
    CUDA_SAFE_CALL(cudaMalloc((void **) &deviceP, mem_size_P ));

    // Clean device memory
    cudaMemset(deviceP, 0, mem_size_P);

    CUT_SAFE_CALL(cutStopTimer(timer_memory));

    // Fin de la solcuión parte 1
    // ===================================================================

    // ===================================================================
    // Comienzo de la solución parte 2
    // Inicializar los bloques de hilos y las diminesiones del grid
    // e invocar al CUDA kernel.
    // Puedes asumir que cada dimensión de la matriz es múltiplo de 
    // de tamaño del bloque definido.
    // ===================================================================

    printf("  Establecer los parametros de ejecución del kernel.\n");
    
    dim3 block(block_size,block_size);
    dim3 grid(Pw/block_size,Ph/block_size);

    printf("  # de hilos en un bloque: %d x %d (%d)\n",
        block.x, block.y, block.x * block.y);
    printf("  # de bloques en un grid: %d x %d (%d)\n",
        grid.x, grid.y, grid.x * grid.y);

    // ================================================
    // Inicializar las dimensiones de bloque y del grid aquí
    // ================================================

    printf("  Ejecutando el kernel...\n");

    // Comienza el timer_compute para calcular cuanto tiempo se consume en él.
    CUT_SAFE_CALL(cutCreateTimer(&timer_compute));
    CUT_SAFE_CALL(cutStartTimer(timer_compute));

    // Invocar el kernel CUDA aquí
    matrixMul<<<grid, block>>>(deviceP, deviceM, deviceN, Mh, Mw, Nw, block_size);

    // Asegurate que todos los hilos han terminado su trabajo antes de parar el timer 
    cudaThreadSynchronize();

    // Para el timer_compute
    CUT_SAFE_CALL(cutStopTimer(timer_compute));

    // Fin de la parte 2 de la solución
    // ===================================================================

    // Comprueba si la ejecución del kernel genera un error
    ERROR_CHECK
    CUT_CHECK_ERROR("Kernel execution failed");

    // ===================================================================
    // Comienza la parte 3 de la solución
    // Copiar los resultados devuelta al host
    // ===================================================================

    CUT_SAFE_CALL(cutStartTimer(timer_memory));

    printf("  Copiar los resultados de la device al host.\n");
    cudaMemcpy(hostP, deviceP, mem_size_P, cudaMemcpyDeviceToHost);

    CUT_SAFE_CALL(cutStopTimer(timer_memory));

    // Fin de la parte 3 de la solución
    // ===================================================================

    // ================================================
    // Mostrar la información de tiempo
    // ================================================

    printf("  GPU memory access time: %f (ms)\n",
        cutGetTimerValue(timer_memory));
    printf("  GPU computation time  : %f (ms)\n",
        cutGetTimerValue(timer_compute));
    printf("  GPU processing time   : %f (ms)\n",
        cutGetTimerValue(timer_compute) + cutGetTimerValue(timer_memory));
    CUT_SAFE_CALL(cutDeleteTimer(timer_memory));
    CUT_SAFE_CALL(cutDeleteTimer(timer_compute));

    // ================================================
    // Hacer la comparación
    // ================================================

    // Comprobamos los resultados si el tamaño de la matriz es <= 512x512
    //if (0) {
    printf("\nComprueba los resultados con los obtenidos por la CPU.\n");
    printf ("  Ejecutando la solución de referencia.\n");
    CUT_SAFE_CALL(cutCreateTimer(&timer_compute));
    CUT_SAFE_CALL(cutStartTimer(timer_compute));

    float* reference = (float*) malloc(mem_size_P);
    computeGold(reference, hostM, hostN, Mh, Mw, Nw);
    CUT_SAFE_CALL(cutStopTimer(timer_compute));

    printf("  Tiempo de procesamiento en la CPU   : %f (ms)\n",
        cutGetTimerValue(timer_compute));
    CUT_SAFE_CALL(cutDeleteTimer(timer_compute));

    printf("  CPU checksum: %g\n", CheckSum(reference, Mw, Nw));

    matrix = (unsigned int *) malloc (Pw * Ph * sizeof(unsigned int));
    for (i = 0; i < Ph; i++)
         for (j = 0; j < Pw; j++)
           matrix[i*Pw + j] = (unsigned int) reference[i*Pw + j];

    WriteMatrixFile("lab2-matrixmul.gold", matrix, Pw, Ph, 1);
    free (matrix); matrix = NULL;
    free(reference);

    printf("  GPU checksum: %g\n", CheckSum(hostP, Mw, Nw));

    /* Escribe la matriz C a un fichero binario de salida */
    matrix = (unsigned int *) malloc (Pw * Ph * sizeof(unsigned int));
    for (i = 0; i < Ph; i++)
        for (j = 0; j < Pw; j++)
	        matrix[i*Pw + j] = (unsigned int) hostP[i*Pw + j];
    WriteMatrixFile("lab2-matrixmul.bin", matrix, Pw, Ph, 1);
    free (matrix); matrix = NULL;

    if (Mw >= 3072 && Mh >= 3072) {
        CompareMatrixFile("lab2-matrixmul.bin", gold_fn, Pw, Ph, if_quiet);
    } else {
        CompareMatrixFile("lab2-matrixmul.bin", "lab2-matrixmul.gold",
            Pw, Ph, if_quiet);
    }
    
    // Limpia la memoria
    free(hostM); free(hostN); free(hostP);
    free(input_fn); free(gold_fn);

    // ===================================================================
    // Comienzo de la parte 4 de la solución
    // Librera device memory
    // ===================================================================

    CUDA_SAFE_CALL(cudaFree(deviceM));
    CUDA_SAFE_CALL(cudaFree(deviceN));
    CUDA_SAFE_CALL(cudaFree(deviceP));

    // Fin de la parte 4 de la solución 
    // ===================================================================
}

