/* Matrix multiplication: P = M * N.
 * código device.
 */

#ifndef _MATRIXMUL_KERNEL_H_
#define _MATRIXMUL_KERNEL_H_

#include "matrixmul.h"

////////////////////////////////////////////////////////////////////////////////
//! Simple test kernel for device functionality
//! @param g_idata  input data in global memory
//! @param g_odata  output data in global memory
////////////////////////////////////////////////////////////////////////////////

    __global__ void
matrixMul(
    float* P, const float* M, const float* N,
    const int Mh, const int Mw, const int Nw,
    const int block_size)
{
    const int bx = blockIdx.x;
    const int by = blockIdx.y;

    const int tx = threadIdx.x;
    const int ty = threadIdx.y;

    float Psub = 0;
    int i = 0, indexM = 0, indexN = 0, indexP = 0;

    // ===================================================================
    // Comienza la parte 5 de la solución 
    // Determinar el índice de salida de cada hilo.
    // Calcular el producto de una fila de M y una columna de N 
    // para cada hilo.
    // Escribir el valor calculado en el índice adecuado de la matriz P.
    // ===================================================================

    // Indice del primer elemento de M cargado por este hilo del bloque
    indexM = by * Mw * block_size + ty * Mw;
	 

    // Indice del primer elemento de N procesado por cada bloque
    indexN = bx * block_size + tx;

    // índice de destino de la matriz
    // Establece el indexP para referenciar el elemento de salida de este hilo
    indexP =indexM + indexN;

    // Para cada índice desde [0, Width of M)
    for (i = 0; i < Mw; i++) {
//	if (tx == 0 && bx == 0) cuPrintf ("Entra en iteracion %d\n", i);
        // Multiplicar sus elementos correspondientes de M y N, y acumular en 
        // un suma parcial Psub.
        Psub += M[indexM] * N[indexN];

        // Actualiza los índices en M y N para la siguiente iteración 
        indexM = indexM + 1;
        indexN = indexN + Nw;
    }
    P[indexP] = Psub;

    // Fin de la parte 5 de la solución ============================================
}

#endif // #ifndef _MATRIXMUL_KERNEL_H_


