---
layout: cabeza3
---

# Clase QImage
QImage es una clase que representa imágenes de mapas de bits (bitmaps) y ofrece diversas funcionalidades para la manipulación de estas, como cargar, guardar, escalar, rotar, acceder a píxeles individuales y realizar operaciones de conversión entre diferentes formatos de imagen. También permite trabajar con imágenes de diferentes profundidades de color y tipos de almacenamiento de píxeles.
***
## Funcionalidades clave de QImage
1. ### Crear y cargar un QImage
    Puedes crear un QImage vacío o cargar una imagen desde un archivo usando su constructor o el método load().

    Ejemplo:
    ```cpp
    QImage image("ruta/a/la/imagen.png");  // Cargar imagen desde un archivo
    ```
    También puedes crear un QImage vacío con un tamaño específico y profundidad de color.

    Ejemplo:
    ```cpp
    QImage image(400, 300, QImage::Format_RGB32);  // Crear una imagen de 400x300 con formato RGB32
    ```
2. ### Acceder y modificar píxeles individuales
    Con QImage, puedes acceder y modificar directamente los píxeles de una imagen usando los métodos pixel(), setPixel(), y bits(). Esto es muy útil para realizar operaciones de procesamiento de imágenes.

    Ejemplo (acceder y modificar un píxel):
    ```cpp
    QImage image(400, 300, QImage::Format_RGB32);
    image.fill(Qt::white);  // Rellenar la imagen de blanco

    QColor color = image.pixelColor(50, 50);  // Obtener el color de un píxel en (50, 50)
    image.setPixelColor(50, 50, Qt::red);     // Establecer el color del píxel en (50, 50) a rojo
    ```
3. ### Escalar una imagen
    Puedes escalar una imagen utilizando el método scaled(), que permite redimensionarla manteniendo o no la relación de aspecto.

    Ejemplo:
    ```cpp
    QImage image("ruta/a/la/imagen.png");
    QImage scaledImage = image.scaled(200, 200, Qt::KeepAspectRatio);
    ```
4. ### Convertir entre formatos de imagen
    QImage permite convertir imágenes entre diferentes formatos de color. Esto es útil cuando se necesita cambiar la representación de color de la imagen, como de escala de grises a RGB.

    Ejemplo:
    ```cpp
    QImage image("ruta/a/la/imagen.png");
    QImage grayscaleImage = image.convertToFormat(QImage::Format_Grayscale8);  // Convertir a escala de grises
    ```
5. ### Guardar una imagen en un archivo
    Puedes guardar una imagen en un archivo utilizando el método save(), y puedes especificar el formato de imagen como "PNG", "JPG", etc.

    Ejemplo:
    ```cpp
    QImage image("ruta/a/la/imagen.png");
    image.save("ruta/a/la/nueva_imagen.jpg", "JPG");
    ```
6. ### Dibujar en una QImage
    Aunque QImage está más orientada al procesamiento de imágenes que a su visualización, puedes usar QPainter para dibujar sobre una QImage.

    Ejemplo:
    ```cpp
    QImage image(400, 300, QImage::Format_RGB32);
    image.fill(Qt::white);  // Rellenar de blanco

    QPainter painter(&image);
    painter.setPen(Qt::blue);
    painter.setFont(QFont("Arial", 30));
    painter.drawText(image.rect(), Qt::AlignCenter, "Texto en la imagen");
    painter.end();

    image.save("imagen_con_texto.png");
    ```
7. ### Transformar una imagen
    QImage permite realizar transformaciones como rotación, espejado y escalado.
    - Rotar una imagen:
    ```cpp
    QImage image("ruta/a/la/imagen.png");
    QMatrix matrix;
    matrix.rotate(90);
    QImage rotatedImage = image.transformed(matrix);
    ```
    - Espejar una imagen:
    ```cpp
    QImage image("ruta/a/la/imagen.png");
    QImage mirroredImage = image.mirrored(true, false);  // Espejo horizontal
    ```
8. ### Acceso eficiente a los píxeles
    Si necesitas manipular directamente los datos en bruto de la imagen, puedes acceder a los bits de la imagen mediante el método bits(). Esto es útil para operaciones de procesamiento de imágenes más avanzadas.

    Ejemplo:
    ```cpp
    QImage image(400, 300, QImage::Format_RGB32);
    uchar* data = image.bits();  // Obtener el puntero a los datos de la imagen
    // Manipular los datos directamente
    ```
***
## Ejemplos prácticos
1. ### Cargar y mostrar una imagen
```cpp
#include <QApplication>
#include <QLabel>
#include <QImage>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLabel label;
    QImage image("ruta/a/la/imagen.png");
    label.setPixmap(QPixmap::fromImage(image));
    label.show();

    return app.exec();
}
```
2. ### Escalar una imagen
Este ejemplo carga una imagen y la escala para ajustarse a un tamaño determinado.
```cpp
#include <QApplication>
#include <QLabel>
#include <QImage>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLabel label;
    QImage image("ruta/a/la/imagen.png");
    QImage scaledImage = image.scaled(200, 200, Qt::KeepAspectRatio);
    label.setPixmap(QPixmap::fromImage(scaledImage));
    label.show();

    return app.exec();
}
```
3. ### Dibujar sobre una imagen
Este ejemplo dibuja texto sobre una imagen utilizando QPainter.
```cpp
#include <QApplication>
#include <QImage>
#include <QPainter>
#include <QLabel>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QImage image(400, 300, QImage::Format_RGB32);
    image.fill(Qt::white);  // Rellenar de blanco

    QPainter painter(&image);
    painter.setPen(Qt::black);
    painter.setFont(QFont("Arial", 20));
    painter.drawText(image.rect(), Qt::AlignCenter, "Texto sobre la imagen");

    QLabel label;
    label.setPixmap(QPixmap::fromImage(image));
    label.show();

    return app.exec();
}
```
4. ### Procesar píxeles directamente
En este ejemplo se accede a los píxeles de la imagen para invertir los colores.
```cpp
#include <QApplication>
#include <QImage>
#include <QLabel>
#include <QColor>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QImage image("ruta/a/la/imagen.png");

    // Invertir colores
    for (int y = 0; y < image.height(); ++y) {
        for (int x = 0; x < image.width(); ++x) {
            QColor color = image.pixelColor(x, y);
            color.setRgb(255 - color.red(), 255 - color.green(), 255 - color.blue());
            image.setPixelColor(x, y, color);
        }
    }

    QLabel label;
    label.setPixmap(QPixmap::fromImage(image));
    label.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Manipulación básica de imágenes:
- Crea una aplicación que cargue una imagen desde el disco, la muestre en un QLabel y permita al usuario escalarla a diferentes tamaños.
2.	### Procesamiento de píxeles:
- Implementa un filtro que convierta una imagen a escala de grises manipulando los píxeles uno por uno.
3.	### Transformaciones:
- Crea una aplicación que permita rotar y espejar una imagen usando QImage y QMatrix.
4.	### Filtros de imagen personalizados:
- Implementa un filtro de imagen que modifique los colores de la imagen cargada, por ejemplo, invirtiendo los colores o aplicando un efecto de sepia.
5.	### Edición de imágenes en tiempo real:
- Crea una aplicación donde el usuario pueda dibujar sobre una imagen cargada utilizando QPainter, con herramientas como líneas, rectángulos y texto.
***
QImage es una herramienta poderosa para el procesamiento de imágenes y manipulación de píxeles en Qt. Su uso es fundamental cuando se necesita un control detallado sobre los datos de la imagen, lo que lo convierte en una excelente opción para la manipulación y el análisis de imágenes.

