---
layout: cabeza3
---

# Clase QHBoxLayout
QHBoxLayout permite colocar widgets en una fila, lo que es ideal para crear barras de herramientas, filas de botones o formularios en los que los elementos se alinean de manera horizontal.
***
## Funcionalidades clave de QHBoxLayout
1. ### Añadir widgets a un QHBoxLayout
    Al igual que en QVBoxLayout, puedes añadir widgets a un QHBoxLayout usando el método addWidget(). Los widgets se colocan uno junto al otro en el orden en que se añaden.

    Ejemplo:
    ```cpp
    QHBoxLayout *layout = new QHBoxLayout;
    QPushButton *button1 = new QPushButton("Botón 1");
    QPushButton *button2 = new QPushButton("Botón 2");
    QPushButton *button3 = new QPushButton("Botón 3");

    layout->addWidget(button1);
    layout->addWidget(button2);
    layout->addWidget(button3);
    ```
2. ### Agregar espacios entre widgets
    Para organizar mejor los widgets, puedes añadir espacio entre ellos usando addSpacing() o addStretch().
    - addSpacing(int size): Añade un espacio fijo de tamaño size entre widgets.
    - addStretch(int stretch = 0): Añade un espacio expansible entre los widgets, ideal para ajustar el espacio de manera automática cuando el contenedor cambia de tamaño.

    Ejemplo:
    ```cpp
    layout->addWidget(button1);
    layout->addSpacing(20);  // Añade 20 píxeles de espacio
    layout->addWidget(button2);
    layout->addStretch();  // Añade un espacio que puede crecer
    layout->addWidget(button3);
    ```
3. ### Definir márgenes del contenedor
    Al igual que en QVBoxLayout, puedes establecer márgenes (el espacio entre el borde del contenedor y los widgets) usando setContentsMargins().
    
    Ejemplo:
    ```cpp
    layout->setContentsMargins(10, 10, 10, 10);  // Márgenes de 10 píxeles en todos los lados
    ```
4. ### Insertar widgets en una posición específica
    Puedes insertar widgets en una posición específica dentro del layout con insertWidget(), lo que te permite controlar el orden en que los widgets aparecen.

    Ejemplo:
    ```cpp
    layout->insertWidget(1, button2);  // Inserta el botón en la posición 1
    ```
5. ### Espaciado entre widgets (setSpacing)
    Controla el espacio general entre todos los widgets dentro del layout usando setSpacing().

    Ejemplo:
    ```cpp
    layout->setSpacing(15);  // Espacio de 15 píxeles entre widgets
    ```
***
## Ejemplos prácticos
1. ### Crear una ventana con botones alineados horizontalmente
```cpp
#include <QApplication>
#include <QWidget>
#include <QHBoxLayout>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QHBoxLayout *layout = new QHBoxLayout;

    QPushButton *button1 = new QPushButton("Botón 1");
    QPushButton *button2 = new QPushButton("Botón 2");
    QPushButton *button3 = new QPushButton("Botón 3");

    layout->addWidget(button1);
    layout->addWidget(button2);
    layout->addWidget(button3);

    window.setLayout(layout);
    window.setWindowTitle("Ejemplo de QHBoxLayout");
    window.show();

    return app.exec();
}
```
2. ### Crear un formulario con campos de texto alineados horizontalmente
```cpp
#include <QApplication>
#include <QWidget>
#include <QHBoxLayout>
#include <QLineEdit>
#include <QLabel>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QHBoxLayout *layout = new QHBoxLayout;

    QLabel *label = new QLabel("Nombre:");
    QLineEdit *lineEdit = new QLineEdit;

    QPushButton *submitButton = new QPushButton("Enviar");

    layout->addWidget(label);
    layout->addWidget(lineEdit);
    layout->addWidget(submitButton);

    window.setLayout(layout);
    window.setWindowTitle("Formulario con QHBoxLayout");
    window.show();

    return app.exec();
}
```
3. ### Agregar estiramiento (stretch) entre widgets
```cpp
#include <QApplication>
#include <QWidget>
#include <QHBoxLayout>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QHBoxLayout *layout = new QHBoxLayout;

    QPushButton *button1 = new QPushButton("Botón 1");
    QPushButton *button2 = new QPushButton("Botón 2");

    layout->addWidget(button1);
    layout->addStretch();  // Espacio expansible
    layout->addWidget(button2);

    window.setLayout(layout);
    window.setWindowTitle("Estiramiento en QHBoxLayout");
    window.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Formulario de búsqueda:
- Crea una ventana que tenga un campo de texto (QLineEdit) para ingresar una búsqueda, y un botón "Buscar" (QPushButton) alineados horizontalmente.
2.	### Barra de botones expansible:
- Implementa una fila de tres botones (QPushButton) donde los dos primeros estén alineados hacia la izquierda y el último esté alineado hacia la derecha usando addStretch() para separar los botones.
3.	### Panel de control con diferentes controles:
- Crea un panel de control con varios controles (como QCheckBox, QPushButton, QLabel, etc.) alineados horizontalmente, separados por espacios con addSpacing().
4.	Ventana con control deslizante y botón:
- Diseña una ventana que tenga un control deslizante (QSlider) y un botón "Aplicar" (QPushButton), organizados horizontalmente. Asegúrate de que el control deslizante ocupe el mayor espacio posible.
5.	### Formulario con etiquetas y campos ajustables:
- Implementa un formulario de contacto que tenga varias etiquetas (QLabel) y campos de texto (QLineEdit) organizados en una fila horizontal. Usa estiramiento para ajustar el espacio entre las etiquetas y los campos.
***
QHBoxLayout es ideal para organizar elementos horizontalmente, proporcionando una disposición estructurada y adaptativa.

