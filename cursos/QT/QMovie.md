---
layout: cabeza3
---

# Clase QMovie
QMovie es una clase de Qt que permite gestionar y reproducir archivos de animación como GIFs animados en aplicaciones Qt. Utilizando QMovie, puedes cargar y controlar animaciones, y mostrar los cuadros de la animación en widgets como QLabel.

Es muy útil cuando se desea incorporar animaciones en una interfaz gráfica, especialmente para mejorar la experiencia de usuario con elementos visuales interactivos, como indicadores de carga animados.
***
## Funcionalidades clave de QMovie
1. ### Inicialización de QMovie
    Para comenzar a usar QMovie, debes cargar el archivo de animación (por ejemplo, un archivo GIF) y luego asociarlo a un widget, generalmente un QLabel, para mostrar los cuadros de la animación.

    Ejemplo básico de creación de un QMovie:
    ```cpp
    QMovie *movie = new QMovie("ruta/a/animacion.gif");
    QLabel *label = new QLabel(this);
    label->setMovie(movie);
    movie->start();  // Inicia la animación
    ```
2. ### Control de reproducción
    Con QMovie, tienes control sobre la reproducción de la animación. Puedes iniciar, detener, pausar, y reanudar la animación, así como saltar a cuadros específicos.

    - Iniciar la animación:
    ```cpp
    movie->start();
    ```
    - Pausar la animación:
    ```cpp
    movie->setPaused(true);
    ```
    - Detener la animación:
    ```cpp
    movie->stop();
    ```
    - Reanudar la animación (si está en pausa):
    ```cpp
    movie->setPaused(false);
    ```
    - Mostrar el estado de reproducción actual:
    ```cpp
    if (movie->state() == QMovie::Running) {
        qDebug() << "La animación está en ejecución";
    }
    ```
3. ### Configuración de reproducción en bucle
    QMovie te permite configurar la cantidad de veces que la animación debe repetirse. El valor por defecto es -1, lo que significa que la animación se repetirá indefinidamente.

    - Configurar el número de repeticiones:
    ```cpp
    movie->setLoopCount(3);  // La animación se repetirá 3 veces
    ```
    - Repetición infinita:
    ```cpp
    movie->setLoopCount(-1);  // La animación se repetirá indefinidamente
    ```
4. ### Control de cuadros específicos
    Puedes controlar el cuadro actual de la animación, así como saltar a un cuadro específico.
    - Obtener el cuadro actual:
    ```cpp
    int currentFrame = movie->currentFrameNumber();
    ```
    - Saltar a un cuadro específico:
    ```cpp
    movie->jumpToFrame(10);  // Salta al cuadro 10 de la animación
    ```
5. ### Obtener el tamaño de la animación
    Puedes obtener las dimensiones de la animación cargada utilizando el método scaledSize() o frameRect().
    - Tamaño escalado de la animación:
    ```cpp
    QSize size = movie->scaledSize();
    qDebug() << "El tamaño de la animación es:" << size;
    ```
    - Escalar la animación a un nuevo tamaño:
    ```cpp
    movie->setScaledSize(QSize(200, 200));  // Escala la animación a 200x200 píxeles
    ```
6. ### Conectar señales para detectar cambios de estado
    QMovie emite varias señales útiles para detectar cambios en la animación, como cuando la animación cambia de cuadro, se detiene o llega al final de un bucle.
    - Señal para detectar cambios de cuadro:
    ```cpp
    connect(movie, &QMovie::frameChanged, this, [](int frame) {
        qDebug() << "El cuadro actual es:" << frame;
    });
    ```
    - Señal para detectar el final de la animación:
    ```cpp
    connect(movie, &QMovie::finished, this, []() {
        qDebug() << "La animación ha terminado";
    });
    ```
***
## Ejemplo práctico de uso de QMovie
1. ### Cargar y mostrar una animación GIF
Este ejemplo muestra cómo cargar un GIF animado en un QLabel y reproducirlo indefinidamente.
```cpp
#include <QApplication>
#include <QLabel>
#include <QMovie>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLabel label;
    QMovie *movie = new QMovie("ruta/a/animacion.gif");

    label.setMovie(movie);
    label.setWindowTitle("Animación GIF");
    label.resize(400, 300);
    label.show();

    movie->start();  // Iniciar la animación

    return app.exec();
}
```
2. ### Pausar y reanudar una animación con botones
En este ejemplo, se crea una ventana que permite al usuario pausar y reanudar una animación mediante botones.
```cpp
#include <QApplication>
#include <QWidget>
#include <QMovie>
#include <QPushButton>
#include <QVBoxLayout>
#include <QLabel>

class MyWidget : public QWidget {
public:
    MyWidget(QWidget *parent = nullptr) : QWidget(parent) {
        QVBoxLayout *layout = new QVBoxLayout(this);

        QLabel *label = new QLabel(this);
        QMovie *movie = new QMovie("ruta/a/animacion.gif");
        label->setMovie(movie);
        movie->start();

        QPushButton *pauseButton = new QPushButton("Pausar", this);
        QPushButton *resumeButton = new QPushButton("Reanudar", this);

        connect(pauseButton, &QPushButton::clicked, movie, [movie]() {
            movie->setPaused(true);  // Pausar la animación
        });

        connect(resumeButton, &QPushButton::clicked, movie, [movie]() {
            movie->setPaused(false);  // Reanudar la animación
        });

        layout->addWidget(label);
        layout->addWidget(pauseButton);
        layout->addWidget(resumeButton);

        setLayout(layout);
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    MyWidget widget;
    widget.show();

    return app.exec();
}
```
3. ### Control de cuadro específico
En este ejemplo, se muestra cómo saltar a un cuadro específico de la animación y mostrarlo en la ventana.
```cpp
#include <QApplication>
#include <QLabel>
#include <QMovie>
#include <QPushButton>
#include <QVBoxLayout>

class MyWidget : public QWidget {
public:
    MyWidget(QWidget *parent = nullptr) : QWidget(parent) {
        QVBoxLayout *layout = new QVBoxLayout(this);

        QLabel *label = new QLabel(this);
        QMovie *movie = new QMovie("ruta/a/animacion.gif");
        label->setMovie(movie);
        movie->start();

        QPushButton *jumpButton = new QPushButton("Saltar al cuadro 10", this);
        connect(jumpButton, &QPushButton::clicked, movie, [movie]() {
            movie->jumpToFrame(10);  // Saltar al cuadro 10
        });

        layout->addWidget(label);
        layout->addWidget(jumpButton);

        setLayout(layout);
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    MyWidget widget;
    widget.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Animación en un QLabel: 
    - Crea una aplicación que cargue un archivo GIF animado en un QLabel y permita iniciar, pausar y detener la animación mediante botones.
2.	### Control de cuadros: 
    - Implementa una aplicación que permita al usuario saltar a cuadros específicos de una animación GIF utilizando un control deslizante (slider).
3.	### Cambio de animación: 
    - Diseña una interfaz gráfica que permita al usuario cambiar entre diferentes animaciones (GIFs) usando un QComboBox o una lista de selección.
4.	### Repetición limitada: 
    - Modifica una aplicación para que la animación se repita un número limitado de veces, y muestra un mensaje cuando la animación haya terminado todas las repeticiones.
***
Con estas capacidades, podrás controlar y manipular animaciones dentro de tus aplicaciones Qt, brindando una experiencia visual más interactiva y atractiva para los usuarios.

