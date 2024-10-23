---
layout: cabeza3
---

# Clase QFutureWatcher
QFutureWatcher es una clase de Qt que permite monitorear y recibir señales cuando un objeto QFuture cambia de estado, es decir, cuando se inicia, se finaliza o se cancela una tarea asíncrona. QFutureWatcher se utiliza para integrar tareas concurrentes con la interfaz gráfica, ya que emite señales que pueden conectarse a los slots en aplicaciones GUI.

Es ideal cuando quieres que la UI sea notificada cuando una tarea larga o costosa ha finalizado, sin necesidad de bloquear el hilo principal.
***
## Características Principales
- Monitorea tareas asíncronas: Proporciona notificaciones a través de señales cuando una tarea ha cambiado de estado.
- Soporte para varias señales: Emite señales cuando la tarea comienza, termina, se cancela o progresa.
- Compatibilidad con múltiples tipos de datos: Se puede utilizar con cualquier tipo de datos manejado por QFuture.
***
## Métodos Principales
1. ### Asignación de un QFuture
    - void setFuture(const QFuture<T> &future)

    Asocia el QFuture especificado con el QFutureWatcher. Esto permite que el QFutureWatcher empiece a monitorear los cambios de estado del futuro.

    ```cpp
    QFutureWatcher<int> watcher;
    QFuture<int> future = QtConcurrent::run([]() { return 42; });
    watcher.setFuture(future);
    ```
2. ### Señales Principales
    - void started()

    Señal emitida cuando la tarea asociada con QFuture ha comenzado.
    ```cpp
    connect(&watcher, &QFutureWatcher<int>::started, []() {
        qDebug() << "La tarea ha comenzado.";
    });
    ```
    - void finished()

    Señal emitida cuando la tarea ha finalizado.
    ```cpp
    connect(&watcher, &QFutureWatcher<int>::finished, []() {
        qDebug() << "La tarea ha finalizado.";
    });
    ```
    - void progressValueChanged(int progressValue)

    Señal emitida cuando cambia el valor de progreso de la tarea.
    ```cpp
    connect(&watcher, &QFutureWatcher<int>::progressValueChanged, [](int value) {
        qDebug() << "Progreso:" << value << "%";
    });
    ```
    - void canceled()

    Señal emitida si la tarea fue cancelada.
    ```cpp
    connect(&watcher, &QFutureWatcher<int>::canceled, []() {
        qDebug() << "La tarea fue cancelada.";
    });
    ```
3. ### Consulta de Estado
    - QFuture<T> future() const

    Devuelve el QFuture que está siendo monitoreado.
    ```cpp
    QFuture<int> currentFuture = watcher.future();
    ```
    - bool isRunning() const

    Devuelve true si la tarea todavía está en ejecución.
    ```cpp
    if (watcher.isRunning()) {
        qDebug() << "La tarea aún está en ejecución.";
    }
    ```
    - bool isFinished() const

    Devuelve true si la tarea ha finalizado.
    ```cpp
    if (watcher.isFinished()) {
        qDebug() << "La tarea ha finalizado.";
    }
    ```
***
## Ejemplo Completo
El siguiente ejemplo muestra cómo ejecutar una tarea asíncrona utilizando QtConcurrent::run(), y cómo usar QFutureWatcher para monitorear su progreso y recibir notificaciones cuando la tarea haya comenzado y finalizado.
main.cpp
```cpp
#include <QCoreApplication>
#include <QtConcurrent/QtConcurrent>
#include <QFutureWatcher>
#include <QDebug>
#include <thread>

// Función simulada que toma tiempo en completarse
int longRunningTask() {
    std::this_thread::sleep_for(std::chrono::seconds(3)); // Simula trabajo pesado
    return 42;
}

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Crear un QFutureWatcher para monitorear la tarea
    QFutureWatcher<int> watcher;

    // Conectar las señales del watcher
    QObject::connect(&watcher, &QFutureWatcher<int>::started, []() {
        qDebug() << "La tarea ha comenzado.";
    });

    QObject::connect(&watcher, &QFutureWatcher<int>::finished, [&watcher]() {
        qDebug() << "La tarea ha finalizado. Resultado:" << watcher.future().result();
    });

    // Ejecutar una tarea asíncrona
    QFuture<int> future = QtConcurrent::run(longRunningTask);

    // Asignar el QFuture al QFutureWatcher
    watcher.setFuture(future);

    return a.exec();
}
```
En este ejemplo, QFutureWatcher se utiliza para monitorear una tarea que simula un trabajo pesado y muestra mensajes cuando la tarea comienza y finaliza.
***
## Ejercicios de Consolidación
1.	### Monitoreo del Progreso
- Implementa una aplicación que ejecute una tarea asíncrona larga (por ejemplo, cálculo de una serie de Fibonacci). Usa QFutureWatcher para monitorear el progreso y actualizar una barra de progreso en la interfaz de usuario.
2.	### Cancelación de Tarea
- Crea un programa que ejecute una tarea larga que sea cancelable a través de un botón en la UI. Usa QFutureWatcher para emitir señales y actualizar la UI cuando la tarea haya sido cancelada o finalizada.
3.	### Varias Tareas Concurrentes
- Modifica el código del ejemplo para ejecutar múltiples tareas concurrentes que realicen diferentes cálculos. Usa múltiples QFutureWatcher para monitorear el estado de cada tarea por separado y mostrar los resultados cuando todas las tareas hayan finalizado.
4.	### Uso de QFutureWatcher con GUI
- Integra QFutureWatcher en una aplicación con interfaz gráfica (usando QPushButton y QProgressBar) donde un botón inicia una tarea y la barra de progreso refleja el progreso de la tarea. Asegúrate de actualizar la UI en las señales progressValueChanged().
***
Con QFutureWatcher, puedes supervisar tareas concurrentes de forma eficiente, asegurándote de que la aplicación pueda reaccionar a los cambios en el estado de las tareas sin bloquear el hilo principal.

