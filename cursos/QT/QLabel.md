---
layout: cabeza3
---

# Clase QLabel
QLabel es una clase que hereda de QFrame y se usa principalmente para mostrar texto o imágenes sin la posibilidad de interacción directa (aunque puede responder a eventos si se desea). Se utiliza comúnmente en interfaces para mostrar información estática o actualizable.
***
## Funcionalidades clave de QLabel
1. ### Constructores
    - QLabel(QWidget *parent = nullptr, Qt::WindowFlags flags = 0): Crea una etiqueta vacía.
    - QLabel(const QString &text, QWidget *parent = nullptr, Qt::WindowFlags flags = 0): Crea una etiqueta con un texto inicial.

    Ejemplo:
    ```cpp
    QLabel *label = new QLabel("Hola, Qt!", this);
    ```
2. ### Texto en la etiqueta
    - setText(const QString &text): Establece el texto de la etiqueta.
    - text(): Devuelve el texto actual de la etiqueta.

    Ejemplo:
    ```cpp
    QLabel *label = new QLabel(this);
    label->setText("¡Bienvenido a Qt!");
    ```
3. ### Mostrar imágenes
    QLabel también puede mostrar imágenes usando el método setPixmap(), que toma un objeto QPixmap.

    Ejemplo:
    ```cpp
    QLabel *imageLabel = new QLabel(this);
    QPixmap pixmap("ruta/a/imagen.png");
    imageLabel->setPixmap(pixmap);
    ```
4. ### Alineación del contenido
    Puedes alinear el texto o la imagen en el QLabel utilizando setAlignment() con las banderas de alineación de Qt (Qt::AlignLeft, Qt::AlignRight, Qt::AlignHCenter, Qt::AlignTop, etc.).

    Ejemplo:
    ```cpp
    QLabel *label = new QLabel("Texto centrado", this);
    label->setAlignment(Qt::AlignCenter);
    ```
5. ### Texto con formato (HTML)
    QLabel puede mostrar texto con formato HTML usando setText() o setTextFormat() con Qt::RichText.

    Ejemplo:
    ```cpp
    QLabel *label = new QLabel(this);
    label->setText("<h1>Encabezado</h1><p>Texto con <b>negrita</b> y <i>cursiva</i>.</p>");
    ```
6. ### Textos largos con elipsis
    Si el texto es muy largo y no cabe en la etiqueta, puedes habilitar el uso de elipsis ("...") para textos truncados mediante setTextElideMode().

    Ejemplo:
    ```cpp
    QLabel *label = new QLabel(this);
    label->setText("Este es un texto muy largo que no cabe en la etiqueta.");
    label->setTextElideMode(Qt::ElideRight);
    ```
7. ### Activar interactividad
    Aunque QLabel no es interactivo por defecto, puedes hacerlo "clicable" habilitando las señales linkActivated y linkHovered si estás mostrando enlaces HTML.

    Ejemplo:
    ```cpp
    QLabel *label = new QLabel(this);
    label->setText("<a href='https://www.qt.io'>Visita Qt</a>");
    label->setTextFormat(Qt::RichText);
    label->setOpenExternalLinks(true);  // Permite abrir enlaces
    ```
8. ### Escalado de imágenes
    Si deseas que la imagen dentro de un QLabel se escale con el tamaño del widget, usa setScaledContents(true).

    Ejemplo:
    ```cpp
    QLabel *imageLabel = new QLabel(this);
    QPixmap pixmap("ruta/a/imagen.png");
    imageLabel->setPixmap(pixmap);
    imageLabel->setScaledContents(true);  // La imagen se escala con el tamaño del QLabel
    ```
***
## Ejemplos prácticos
1. ### Mostrar texto simple y alineación
```cpp
#include <QApplication>
#include <QLabel>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLabel label("¡Bienvenido a la aplicación!");
    label.setAlignment(Qt::AlignCenter);  // Centrar el texto
    label.resize(300, 100);
    label.show();

    return app.exec();
}
```
2. ### Mostrar una imagen
```cpp
#include <QApplication>
#include <QLabel>
#include <QPixmap>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLabel imageLabel;
    QPixmap pixmap("ruta/a/imagen.png");
    imageLabel.setPixmap(pixmap);
    imageLabel.resize(pixmap.size());
    imageLabel.show();

    return app.exec();
}
```
3. ### Texto con formato HTML
```cpp
#include <QApplication>
#include <QLabel>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLabel label;
    label.setText("<h2>Texto con <i>HTML</i> y <u>formato</u></h2>");
    label.setAlignment(Qt::AlignCenter);
    label.resize(300, 100);
    label.show();

    return app.exec();
}
```
4. ### Escalar imágenes dentro de QLabel
```cpp
#include <QApplication>
#include <QLabel>
#include <QPixmap>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLabel imageLabel;
    QPixmap pixmap("ruta/a/imagen.png");
    imageLabel.setPixmap(pixmap);
    imageLabel.setScaledContents(true);  // Escalar la imagen con el tamaño del QLabel
    imageLabel.resize(300, 300);
    imageLabel.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Texto dinámico:
- Crea una aplicación donde un QLabel muestra el texto de un cuadro de texto (QLineEdit) en tiempo real. Usa QLineEdit::textChanged para actualizar el QLabel cada vez que el usuario escriba algo.
2.	### Imágenes y escalado:
- Diseña una aplicación donde se muestren imágenes en un QLabel y el tamaño del QLabel cambie con el tamaño de la ventana, escalando la imagen automáticamente.
3.	### Texto con HTML avanzado:
- Crea un QLabel que muestre una lista de elementos con texto formateado usando HTML, y permite enlaces que se abran en el navegador cuando se hagan clic.
4.	### Textos largos con elipsis:
- Crea un QLabel que muestre un texto largo y habilita la opción para que cuando el texto no quepa en la etiqueta, se muestre con elipsis ("...") al final.
***
Esto cubre las características principales de QLabel.

