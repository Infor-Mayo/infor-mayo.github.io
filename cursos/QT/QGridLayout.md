---
layout: cabeza3
---


# Clase QGridLayout
QGridLayout te permite organizar widgets en una cuadrícula de celdas, donde puedes especificar en qué fila y columna se colocará cada widget. También puedes hacer que los widgets ocupen varias filas o columnas, lo que lo hace muy versátil.
***
## Funcionalidades clave de QGridLayout
1. ### Añadir widgets a una cuadrícula
    Para añadir un widget a una celda específica, utilizas el método addWidget() y defines en qué fila y columna se debe colocar.

    Ejemplo:
    ```cpp
    QGridLayout *layout = new QGridLayout;
    QPushButton *button1 = new QPushButton("Botón 1");
    QPushButton *button2 = new QPushButton("Botón 2");
    QPushButton *button3 = new QPushButton("Botón 3");

    layout->addWidget(button1, 0, 0);  // Fila 0, Columna 0
    layout->addWidget(button2, 0, 1);  // Fila 0, Columna 1
    layout->addWidget(button3, 1, 0);  // Fila 1, Columna 0
    ```
2. ### Especificar el número de filas y columnas que ocupa un widget
    Puedes hacer que un widget ocupe varias filas o columnas usando los parámetros adicionales de addWidget().
    - addWidget(widget, fila, columna, filas, columnas): Añade un widget que se extiende a través de varias filas o columnas.

    Ejemplo:
    ```cpp
    layout->addWidget(button1, 0, 0, 1, 2);  // Fila 0, ocupa 2 columnas
    layout->addWidget(button2, 1, 0);        // Fila 1, Columna 0
    layout->addWidget(button3, 1, 1);        // Fila 1, Columna 1
    ```
3. ### Ajustar el espaciado entre las celdas
    Puedes controlar el espacio entre las celdas de la cuadrícula usando setSpacing() para ajustar la distancia general entre widgets, y setContentsMargins() para definir los márgenes alrededor del contenedor.

    Ejemplo:
    ```cpp
    layout->setSpacing(10);  // Espaciado de 10 píxeles entre celdas
    layout->setContentsMargins(5, 5, 5, 5);  // Márgenes de 5 píxeles en todos los lados
    ```
4. ### Establecer estiramiento para filas y columnas
    Puedes controlar cómo se distribuye el espacio entre las filas y columnas usando setRowStretch() y setColumnStretch(). Estos métodos permiten definir qué filas o columnas se expanden más cuando la ventana cambia de tamaño.

    Ejemplo:
    ```cpp
    layout->setRowStretch(0, 1);   // La fila 0 puede expandirse más
    layout->setColumnStretch(1, 1);  // La columna 1 puede expandirse más
    ```
5. Controlar la alineación de los widgets
    Puedes alinear los widgets dentro de las celdas de la cuadrícula utilizando las banderas de alineación de Qt como Qt::AlignLeft, Qt::AlignRight, Qt::AlignTop, Qt::AlignBottom, etc.

    Ejemplo:
    ```cpp
    layout->addWidget(button1, 0, 0, Qt::AlignLeft);  // Botón alineado a la izquierda
    layout->addWidget(button2, 1, 0, Qt::AlignCenter);  // Botón centrado
    ```
***
## Ejemplos prácticos
1. ### Crear una ventana con botones en una cuadrícula
```cpp
#include <QApplication>
#include <QWidget>
#include <QGridLayout>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QGridLayout *layout = new QGridLayout;

    QPushButton *button1 = new QPushButton("Botón 1");
    QPushButton *button2 = new QPushButton("Botón 2");
    QPushButton *button3 = new QPushButton("Botón 3");
    QPushButton *button4 = new QPushButton("Botón 4");

    layout->addWidget(button1, 0, 0);  // Fila 0, Columna 0
    layout->addWidget(button2, 0, 1);  // Fila 0, Columna 1
    layout->addWidget(button3, 1, 0);  // Fila 1, Columna 0
    layout->addWidget(button4, 1, 1);  // Fila 1, Columna 1

    window.setLayout(layout);
    window.setWindowTitle("Ejemplo de QGridLayout");
    window.show();

    return app.exec();
}
```
2. ### Crear un formulario usando QGridLayout
```cpp
#include <QApplication>
#include <QWidget>
#include <QGridLayout>
#include <QLineEdit>
#include <QLabel>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QGridLayout *layout = new QGridLayout;

    QLabel *nameLabel = new QLabel("Nombre:");
    QLineEdit *nameEdit = new QLineEdit;

    QLabel *emailLabel = new QLabel("Correo:");
    QLineEdit *emailEdit = new QLineEdit;

    QPushButton *submitButton = new QPushButton("Enviar");

    layout->addWidget(nameLabel, 0, 0);  // Fila 0, Columna 0
    layout->addWidget(nameEdit, 0, 1);   // Fila 0, Columna 1
    layout->addWidget(emailLabel, 1, 0);  // Fila 1, Columna 0
    layout->addWidget(emailEdit, 1, 1);   // Fila 1, Columna 1
    layout->addWidget(submitButton, 2, 0, 1, 2);  // Fila 2, ocupa 2 columnas

    window.setLayout(layout);
    window.setWindowTitle("Formulario con QGridLayout");
    window.show();

    return app.exec();
}
```
3. ### Crear una cuadrícula con estiramiento
```cpp
#include <QApplication>
#include <QWidget>
#include <QGridLayout>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QGridLayout *layout = new QGridLayout;

    QPushButton *button1 = new QPushButton("Botón 1");
    QPushButton *button2 = new QPushButton("Botón 2");
    QPushButton *button3 = new QPushButton("Botón 3");

    layout->addWidget(button1, 0, 0);  // Fila 0, Columna 0
    layout->addWidget(button2, 0, 1);  // Fila 0, Columna 1
    layout->addWidget(button3, 1, 0, 1, 2);  // Fila 1, ocupa 2 columnas

    layout->setRowStretch(0, 1);   // Fila 0 se puede expandir
    layout->setColumnStretch(1, 1);  // Columna 1 se puede expandir

    window.setLayout(layout);
    window.setWindowTitle("Cuadrícula con estiramiento");
    window.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Formulario con múltiples campos:
- Crea un formulario con etiquetas (QLabel) y campos de texto (QLineEdit) dispuestos en una cuadrícula. Asegúrate de que los campos de texto estén alineados correctamente con las etiquetas.
2.	### Calculadora simple:
- Implementa una calculadora con botones dispuestos en una cuadrícula de 4x4. Los botones deben representar los dígitos (0-9) y las operaciones básicas (+, -, *, /).
3.	### Ventana con diferentes tamaños de widgets:
- Crea una ventana donde algunos widgets ocupen más de una columna o fila. Experimenta con addWidget() para expandir widgets a través de múltiples celdas.
4.	### Cuadrícula con control de estiramiento:
- Diseña una cuadrícula con diferentes controles (QPushButton, QLabel, etc.), donde algunas filas o columnas se expanden más que otras al cambiar el tamaño de la ventana.
5.	### Panel de control con distribución ajustable:
- Implementa un panel de control donde cada control esté alineado en una cuadrícula con un espaciado personalizado entre celdas. Usa márgenes para ajustar la separación del contenido respecto al borde del contenedor.
***
QGridLayout es una herramienta poderosa para organizar widgets de manera flexible y detallada, permitiendo un control total sobre la disposición de los elementos en una cuadrícula.

