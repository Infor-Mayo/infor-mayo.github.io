# Clase QCoreApplication 

Esta clase es fundamental para manejar temporizadores en Qt, y se utiliza para ejecutar código repetidamente en intervalos específicos o después de un tiempo determinado.

La clase QTimer es parte del módulo de QtCore y proporciona un temporizador de alta precisión que puede ser usado para generar eventos repetidos o únicos en intervalos de tiempo específicos. Es muy útil en aplicaciones que necesitan acciones basadas en tiempo, como actualizar interfaces de usuario, realizar tareas periódicas o ejecutar acciones con retraso.

***

## Funcionalidades principales de QTimer

1. ### Constructor
    - QTimer(QObject *parent = nullptr): Crea un temporizador que, opcionalmente, tiene un objeto padre. Si se le asigna un padre, el temporizador será destruido automáticamente cuando se destruya el objeto padre.
    
    Ejemplo:
    ```cpp
    QTimer *timer = new QTimer(this);  // Se destruirá automáticamente con "this"
    ```
2. ### Método start()
    - void start(int msec): Inicia el temporizador con el intervalo especificado en milisegundos. El temporizador emitirá una señal (timeout()) cada vez que se cumpla el intervalo.
    
    Ejemplo:
    ```cpp
    QTimer *timer = new QTimer(this);
    timer->start(1000);  // Se activará cada 1000 ms (1 segundo)
    ```
3. ### Método stop()
    - void stop(): Detiene el temporizador. No emitirá más señales hasta que se vuelva a iniciar.
    
    Ejemplo:
    ```cpp
    timer->stop();  // Detiene el temporizador
    ```
4. ### Método setInterval() y interval()
    - void setInterval(int msec): Establece el intervalo del temporizador en milisegundos.
    - int interval(): Devuelve el intervalo actual del temporizador.
    
    Ejemplo:
    ```cpp
    timer->setInterval(2000);  // Cambia el intervalo a 2000 ms (2 segundos)
    qDebug() << "Intervalo actual:" << timer->interval();  // Devuelve 2000
    ```
5. ### Método singleShot()
    - static void singleShot(int msec, const QObject *receiver, const char *method): Crea un temporizador de disparo único. Después de que transcurra el tiempo especificado, se ejecutará el método del receptor una sola vez.
    
    Ejemplo:
    ```cpp
    QTimer::singleShot(5000, this, SLOT(onTimeout()));  // Llama a onTimeout() después de 5 segundos
    ```
6. ### Método isActive()
    - bool isActive(): Devuelve true si el temporizador está en funcionamiento (si fue iniciado y no se ha detenido).
    
    Ejemplo:
    ```cpp
    if (timer->isActive()) {
        qDebug() << "El temporizador está activo.";
    }
    ```
7. ### Método remainingTime()
    - int remainingTime(): Devuelve el tiempo que queda hasta que el temporizador emita la siguiente señal timeout(), en milisegundos.
    
    Ejemplo:
    ```cpp
    qDebug() << "Tiempo restante para el siguiente timeout:" << timer->remainingTime();
    ```

8. ### Método timeout()
    - Señal timeout(): Esta señal es emitida cada vez que el temporizador alcanza el final de su intervalo.
    
    Ejemplo:
    ```cpp
    connect(timer, &QTimer::timeout, this, &MyClass::onTimeout);  // Conecta la señal con un slot
    ```

***

## Ejemplos prácticos

1. ### Temporizador simple de repetición
    Este ejemplo muestra cómo crear un temporizador que imprime un mensaje en la consola cada segundo.
   
   ```cpp
    #include <QCoreApplication>
    #include <QTimer>
    #include <QDebug>

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);
        
        QTimer timer;
        QObject::connect(&timer, &QTimer::timeout, []() {
            qDebug() << "Temporizador activado";
        });

        timer.start(1000);  // Emite "timeout" cada 1 segundo

        return a.exec();
    }
    ```

2. ### Temporizador de disparo único
    En este caso, el temporizador ejecuta un método una sola vez después de un intervalo de tiempo determinado.
   
    ```cpp
    #include <QCoreApplication>
    #include <QTimer>
    #include <QDebug>

    void disparaUnaVez() {
        qDebug() << "Este mensaje se muestra después de 3 segundos.";
    }

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);
        
        QTimer::singleShot(3000, &disparaUnaVez);  // Ejecuta "disparaUnaVez()" después de 3 segundos

        return a.exec();
    }
    ```
3. ### Temporizador que se detiene
    Este ejemplo crea un temporizador que se detiene a sí mismo después de tres ejecuciones.
   
    ```cpp
    #include <QCoreApplication>
    #include <QTimer>
    #include <QDebug>

    int contador = 0;

    void detenerTemporizador(QTimer *timer) {
        contador++;
        qDebug() << "Temporizador activado:" << contador;
        if (contador == 3) {
            qDebug() << "Temporizador detenido.";
            timer->stop();
        }
    }

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);
        
        QTimer timer;
        QObject::connect(&timer, &QTimer::timeout, [&]() {
            detenerTemporizador(&timer);
        });

        timer.start(1000);  // Emite "timeout" cada 1 segundo

        return a.exec();
    }
    ```
4. ### Temporizador con intervalo dinámico
    En este ejemplo, se demuestra cómo cambiar el intervalo del temporizador dinámicamente.
   
    ```cpp
    #include <QCoreApplication>
    #include <QTimer>
    #include <QDebug>

    void cambiarIntervalo(QTimer *timer) {
        static int intervalo = 1000;
        intervalo += 500;
        timer->setInterval(intervalo);
        qDebug() << "Nuevo intervalo del temporizador:" << intervalo;
    }

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);
        
        QTimer timer;
        QObject::connect(&timer, &QTimer::timeout, [&]() {
            cambiarIntervalo(&timer);
        });

        timer.start(1000);  // Comienza con un intervalo de 1 segundo

        return a.exec();
    }
    ```

***

## Ejercicios de Consolidación

1.	### Temporizador con salida periódica:
    - Crea una aplicación que use un QTimer para imprimir un mensaje en la consola cada 2 segundos. Detén el temporizador después de que se haya activado 5 veces.

2.	### Temporizador con disparo único:
    - Crea una aplicación que ejecute una función una vez después de 10 segundos usando QTimer::singleShot(). La función debe mostrar un mensaje en la consola que diga "¡Tiempo agotado!".

3.	### Temporizador con intervalo dinámico:
    - Implementa un temporizador que comience con un intervalo de 1 segundo y que aumente su intervalo en 1 segundo cada vez que se activa. Después de 5 activaciones, el temporizador debe detenerse automáticamente.

4.	### Temporizador de cuenta regresiva:
    - Crea una aplicación que simule una cuenta regresiva de 10 segundos. Cada segundo, debe imprimir el tiempo restante hasta que llegue a 0, momento en el que se debe imprimir "¡Fin del tiempo!".

5.	### Ejemplo avanzado:
    - Crea una aplicación que use varios temporizadores simultáneamente para ejecutar diferentes tareas en intervalos de tiempo distintos. Por ejemplo, uno puede imprimir un mensaje cada 2 segundos y otro puede hacer una tarea diferente cada 3 segundos.

***

Con esta información y ejercicios, habrás cubierto todos los aspectos básicos y avanzados del uso de QTimer.

