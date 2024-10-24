---
layout: cabeza3
---

# Clase QMutex
QMutex es una clase en Qt que implementa un mutex (mutual exclusion), que es un mecanismo de sincronización utilizado para proteger recursos compartidos entre diferentes hilos. Al usar un QMutex, puedes asegurarte de que solo un hilo acceda a una sección crítica del código (o recurso compartido) al mismo tiempo, evitando condiciones de carrera y problemas de concurrencia.
## Herencia
QMutex hereda de QObject, lo que permite su integración en el ecosistema de señales y slots de Qt, aunque normalmente se usa en situaciones de multithreading.
Modos de Operación de QMutex
- Modo Normal: Solo el hilo que bloquea el mutex puede desbloquearlo.
- Modo Recursivo: El mismo hilo puede bloquear el mutex varias veces, pero debe desbloquearlo el mismo número de veces.
## Constructores
1. QMutex(QMutex::RecursionMode mode = QMutex::NonRecursive)
Crea un mutex. Por defecto, es un mutex no recursivo. Si se pasa QMutex::Recursive, el mutex permite que el mismo hilo lo bloquee varias veces.
## Métodos de la Clase QMutex
1. ### void lock()
    Bloquea el mutex. Si otro hilo ya lo ha bloqueado, el hilo que llama a lock() esperará hasta que el mutex esté disponible.
    - Uso típico: Utilizado para evitar que otros hilos accedan a una sección crítica del código al mismo tiempo.
2. ### bool tryLock(int timeout = 0)
    Intenta bloquear el mutex. Si está disponible, lo bloquea y devuelve true; de lo contrario, devuelve false. Si se especifica un tiempo de espera (en milisegundos), el hilo esperará hasta ese tiempo antes de devolver false si no puede bloquear el mutex.
    - Uso típico: Para evitar bloqueos indefinidos, especialmente en operaciones que pueden tomar mucho tiempo.
3. ### void unlock()
    Desbloquea el mutex, permitiendo que otros hilos lo bloqueen.
    - Uso típico: Siempre se debe llamar a unlock() después de haber bloqueado un mutex con lock() para evitar deadlocks (bloqueos mutuos).
4. ### bool isRecursive() const
    Indica si el mutex es recursivo o no.
    - Uso típico: Para verificar si el mutex fue creado en modo recursivo o no.
***
## Ejemplo Básico de Uso de QMutex
A continuación, se muestra cómo usar QMutex para proteger una sección crítica del código:
```cpp
#include <QApplication>
#include <QThread>
#include <QMutex>
#include <QDebug>

QMutex mutex;

class Worker : public QThread
{
    void run() override {
        for (int i = 0; i < 5; ++i) {
            mutex.lock();  // Bloquea el acceso
            qDebug() << "Thread" << QThread::currentThreadId() << "is working:" << i;
            mutex.unlock();  // Desbloquea el acceso
            QThread::sleep(1);  // Simula una operación que toma tiempo
        }
    }
};

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    Worker worker1;
    Worker worker2;

    worker1.start();  // Inicia el primer hilo
    worker2.start();  // Inicia el segundo hilo

    worker1.wait();
    worker2.wait();

    return app.exec();
}
```
En este ejemplo:
- mutex.lock(): Bloquea el acceso a la sección crítica (el bloque de código protegido por el mutex).
- mutex.unlock(): Libera el acceso, permitiendo que otros hilos bloqueen el mutex.
- Hilos múltiples: Dos hilos (worker1 y worker2) acceden a la misma sección crítica, pero gracias al mutex, solo uno puede hacerlo a la vez.
## Ejemplo Usando tryLock()
En lugar de bloquear el hilo indefinidamente, tryLock() permite intentar adquirir el mutex con un tiempo de espera opcional.
```cpp
#include <QApplication>
#include <QThread>
#include <QMutex>
#include <QDebug>

QMutex mutex;

class Worker : public QThread
{
    void run() override {
        for (int i = 0; i < 5; ++i) {
            if (mutex.tryLock(500)) {  // Intenta bloquear el mutex por 500 ms
                qDebug() << "Thread" << QThread::currentThreadId() << "is working:" << i;
                mutex.unlock();
            } else {
                qDebug() << "Thread" << QThread::currentThreadId() << "couldn't acquire the mutex!";
            }
            QThread::sleep(1);  // Simula una operación que toma tiempo
        }
    }
};

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    Worker worker1;
    Worker worker2;

    worker1.start();
    worker2.start();

    worker1.wait();
    worker2.wait();

    return app.exec();
}
```
En este ejemplo:
- tryLock(): Intenta bloquear el mutex con un tiempo de espera de 500 ms. Si el mutex no está disponible dentro de ese tiempo, el hilo continúa sin bloquearlo.
- Esto es útil cuando no quieres que un hilo espere indefinidamente si el mutex está bloqueado.
***
## Ejercicios de Consolidación
1.	### Acceso a Recursos Compartidos: 
    - Crea una aplicación que simule varios hilos escribiendo en un archivo de texto. Usa QMutex para asegurarte de que solo un hilo puede escribir en el archivo a la vez.
2.	### Protección de Variables Globales: 
    - Crea una aplicación donde varios hilos modifiquen una variable global (como un contador). Usa un QMutex para proteger la variable y evitar condiciones de carrera.
3.	### Bloqueo Condicional: 
    - Implementa un sistema donde varios hilos intentan adquirir un QMutex usando tryLock(). Si un hilo no puede adquirir el mutex dentro de un tiempo determinado, debe realizar otra tarea alternativa.
4.	### Simulación de Banco: 
    - Crea una simulación de un sistema bancario con varias cuentas. Usa hilos para simular diferentes transacciones y un QMutex para proteger el acceso a las cuentas, evitando problemas de concurrencia.
5.	### Productor-Consumidor con Mutex: 
    - Implementa el clásico problema de productor-consumidor usando QMutex. Un hilo producirá datos (por ejemplo, números enteros) y otro hilo los consumirá. Usa el mutex para sincronizar el acceso a la cola de datos compartida.
***
Estos ejercicios te permitirán comprender mejor cómo usar QMutex para evitar problemas de concurrencia en programas multithreaded en Qt y asegurar el acceso seguro a los recursos compartidos entre hilos.

