---
layout: cabeza3
---

# Clase QFuture
La clase QFuture de Qt proporciona una forma de manejar tareas asíncronas y permite consultar su estado mientras se ejecutan en segundo plano. Es parte del módulo Qt Concurrent y se usa en combinación con funciones como QtConcurrent::run() o QtConcurrent::map().
QFuture es una abstracción de una tarea que está en progreso o se completará en algún momento futuro. Permite consultar si la tarea ha terminado, cancelar la ejecución, o recuperar el resultado una vez completada.
***
## Características Principales
- Se usa para manejar tareas que se ejecutan de manera asíncrona en un hilo separado.
- Permite comprobar el estado de la tarea (si está en progreso, terminada, etc.).
- Puede devolver el resultado de la tarea, si corresponde.
- Proporciona soporte para la cancelación y finalización anticipada de tareas.
***
## Métodos Principales
1. ### Estado de la Tarea
    - bool isFinished() const

    Devuelve true si la tarea ha finalizado.
    ```cpp
    QFuture<int> future = QtConcurrent::run([]() { return 42; });
    if (future.isFinished()) {
        qDebug() << "La tarea ha finalizado.";
    }
    ```
    - bool isRunning() const

    Devuelve true si la tarea está en ejecución.
    ```cpp
    if (future.isRunning()) {
        qDebug() << "La tarea está en progreso.";
    }
    ```
    - bool isCanceled() const

    Devuelve true si la tarea fue cancelada.
    ```cpp
    if (future.isCanceled()) {
        qDebug() << "La tarea fue cancelada.";
    }
    ```
    - int progressValue() const

    Devuelve el progreso de la tarea, normalmente en un rango de 0 a 100.
    ```cpp
    qDebug() << "Progreso:" << future.progressValue() << "%";
    ```
2. ### Recuperación del Resultado
    - T result() const

    Devuelve el resultado de la tarea cuando se ha completado. Este método bloqueará la ejecución hasta que la tarea finalice si aún no ha terminado.
    ```cpp
    int result = future.result();
    qDebug() << "Resultado de la tarea:" << result;
    ```
    - QList<T> results() const

    Si la tarea devuelve múltiples resultados, este método los devolverá todos en forma de lista.
    ```cpp
    QFuture<QList<int>> future = QtConcurrent::run([]() { return QList<int> {1, 2, 3}; });
    QList<int> results = future.results();
    ```
3. ### Cancelación y Finalización de Tareas
    - void cancel()

    Intenta cancelar la tarea si es posible. No todas las tareas permiten ser canceladas.
    ```cpp
    future.cancel();
    if (future.isCanceled()) {
        qDebug() << "La tarea ha sido cancelada.";
    }
    ```
    - void waitForFinished()

    Bloquea la ejecución actual hasta que la tarea haya finalizado.
    ```cpp
    future.waitForFinished();
    qDebug() << "La tarea ha finalizado.";
    ```
4. ### Interacción con QFutureWatcher
    Para manejar eventos o notificaciones cuando una tarea asíncrona cambia de estado, QFuture se puede combinar con QFutureWatcher, que emite señales cuando la tarea ha terminado, ha sido cancelada, etc.
***
## Ejemplo Completo
El siguiente ejemplo muestra cómo ejecutar una tarea asíncrona que devuelve un valor entero usando QtConcurrent::run() y luego recuperar el resultado de la tarea con QFuture.
main.cpp
```cpp
#include <QCoreApplication>
#include <QtConcurrent/QtConcurrent>
#include <QDebug>
#include <QFuture>

int calculateFactorial(int n) {
    int result = 1;
    for (int i = 1; i <= n; ++i) {
        result *= i;
    }
    return result;
}

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Ejecutar tarea asíncrona
    QFuture<int> future = QtConcurrent::run(calculateFactorial, 5);

    // Esperar a que la tarea finalice
    future.waitForFinished();

    // Recuperar el resultado
    int result = future.result();
    qDebug() << "El factorial de 5 es:" << result;

    return a.exec();
}
```
Este ejemplo ejecuta una tarea de cálculo del factorial de un número y espera a que la tarea termine para imprimir el resultado.
***
## Ejercicios de Consolidación
1.	### Cálculo Concurrente
- Crea una función que calcule la suma de los números del 1 al n de manera concurrente usando QFuture. Implementa un mecanismo para consultar el progreso de la tarea.
2.	### Tareas Cancelables
- Modifica la tarea anterior para que sea cancelable antes de completarse. Implementa un botón o evento que permita cancelar la tarea y muestra un mensaje si la tarea fue cancelada con éxito.
3.	### Uso de QFutureWatcher
- Integra QFutureWatcher con una tarea concurrente que realice operaciones sobre un archivo grande. Muestra el progreso del procesamiento del archivo y notifica cuando la tarea ha terminado o ha sido cancelada.
4.	### Múltiples Resultados
- Crea una tarea concurrente que procese una lista de números y devuelva una lista de resultados (por ejemplo, cuadrado de cada número). Usa QFuture para recoger y mostrar los resultados.
***
Con QFuture, es posible gestionar tareas asíncronas y mantener la interacción con la aplicación mientras esas tareas se ejecutan en segundo plano. Esto es útil para evitar bloqueos en la interfaz de usuario y permitir la ejecución fluida de tareas que puedan tardar en completarse.

