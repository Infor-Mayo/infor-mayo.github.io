---
layout: cabeza3
---

# Clase QClipboard
La clase QClipboard en Qt proporciona acceso al portapapeles del sistema. El portapapeles es una herramienta utilizada para transferir datos entre aplicaciones o dentro de la misma aplicación mediante las operaciones de "copiar", "cortar" y "pegar". QClipboard permite gestionar el texto, imágenes y otros tipos de contenido que se guardan temporalmente en el portapapeles.

***

## Características Principales de QClipboard
- Interfaz para el Portapapeles del Sistema: Proporciona una manera fácil de interactuar con el portapapeles del sistema operativo.
- Gestión de Varios Tipos de Datos: Soporta texto, imágenes y otros formatos MIME.
- Notificaciones de Cambios: Puede notificar cuando el contenido del portapapeles cambia.

***

## Métodos Principales de QClipboard
1. ### text()
    Devuelve el texto almacenado en el portapapeles.
    ```cpp
    QString text(QClipboard::Mode mode = QClipboard::Clipboard) const;
    ```
    - mode: Especifica el portapapeles. Por defecto, usa QClipboard::Clipboard.
    - QClipboard::Clipboard: El portapapeles estándar.
    - QClipboard::Selection: Usado en algunos sistemas Unix para manejar la selección primaria.

    Ejemplo:
    ```cpp
    QString clipboardText = QGuiApplication::clipboard()->text();
    qDebug() << "Texto en el portapapeles:" << clipboardText;
    ```
2. ### setText()
    Establece un texto en el portapapeles.
    ```cpp
    void setText(const QString &text, QClipboard::Mode mode = QClipboard::Clipboard);
    ```
    - text: El texto que se va a almacenar en el portapapeles.
    - mode: Especifica el portapapeles, similar a text().

    Ejemplo:
    ```cpp
    QGuiApplication::clipboard()->setText("Texto copiado al portapapeles");
    ```
3. ### image()
    Devuelve la imagen almacenada en el portapapeles como un QImage.
    ```cpp
    QImage image(QClipboard::Mode mode = QClipboard::Clipboard) const;
    ```
    Ejemplo:
    ```cpp
    QImage clipboardImage = QGuiApplication::clipboard()->image();
    if (!clipboardImage.isNull()) {
        qDebug() << "Imagen obtenida del portapapeles.";
    }
    ```
4. ### setImage()
    Establece una imagen en el portapapeles.
    ```cpp
    void setImage(const QImage &image, QClipboard::Mode mode = QClipboard::Clipboard);
    ```
    - image: La imagen que se va a almacenar en el portapapeles.
    Ejemplo:
    ```cpp
    QImage image("ruta/a/la/imagen.png");
    QGuiApplication::clipboard()->setImage(image);
    ```
5. ### pixmap()
    Devuelve la imagen como un QPixmap desde el portapapeles.
    ```cpp
    QPixmap pixmap(QClipboard::Mode mode = QClipboard::Clipboard) const;
    ```
    Ejemplo:
    ```cpp
    QPixmap clipboardPixmap = QGuiApplication::clipboard()->pixmap();
    if (!clipboardPixmap.isNull()) {
        qDebug() << "Pixmap obtenido del portapapeles.";
    }
    ```
6. ### setPixmap()
    Establece un QPixmap en el portapapeles.
    ```cpp
    void setPixmap(const QPixmap &pixmap, QClipboard::Mode mode = QClipboard::Clipboard);
    ```
    Ejemplo:
    ```cpp
    QPixmap pixmap("ruta/a/la/imagen.png");
    QGuiApplication::clipboard()->setPixmap(pixmap);
    ```
7. ### clear()
    Limpia el contenido del portapapeles.
    ```cpp
    void clear(QClipboard::Mode mode = QClipboard::Clipboard);
    ```
    Ejemplo:
    ```cpp
    QGuiApplication::clipboard()->clear();
    qDebug() << "Portapapeles limpiado.";
    ```

***

## Señales Importantes
1. ### changed()
    Esta señal se emite cuando el contenido del portapapeles cambia.
    ```cpp
    void changed(QClipboard::Mode mode);
    ```
    - mode: Indica qué portapapeles ha cambiado (clipboard, selection, etc.).
    Ejemplo:
    ```cpp
    connect(QGuiApplication::clipboard(), &QClipboard::changed, [](QClipboard::Mode mode) {
        qDebug() << "El portapapeles ha cambiado.";
    });
    ```

***

## Ejemplo Completo de Uso de QClipboard
El siguiente código muestra cómo copiar y pegar texto utilizando QClipboard:
```cpp
#include <QApplication>
#include <QClipboard>
#include <QDebug>
#include <QPushButton>
#include <QVBoxLayout>
#include <QWidget>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout(&window);

    QPushButton copyButton("Copiar Texto al Portapapeles");
    QPushButton pasteButton("Pegar Texto del Portapapeles");

    layout.addWidget(&copyButton);
    layout.addWidget(&pasteButton);

    QObject::connect(&copyButton, &QPushButton::clicked, []() {
        QGuiApplication::clipboard()->setText("Texto de ejemplo copiado.");
        qDebug() << "Texto copiado al portapapeles.";
    });

    QObject::connect(&pasteButton, &QPushButton::clicked, []() {
        QString clipboardText = QGuiApplication::clipboard()->text();
        qDebug() << "Texto pegado desde el portapapeles:" << clipboardText;
    });

    window.show();
    return app.exec();
}
```
Este ejemplo copia un texto fijo al portapapeles cuando se presiona un botón y lo pega cuando se presiona otro.

***

## Ejercicios de Consolidación
1.	### Copiar y Pegar Texto
- Crea una aplicación que permita al usuario escribir texto en un QLineEdit, copiarlo al portapapeles y pegarlo en otro QLineEdit.
2.	### Manejo de Imágenes
- Escribe una aplicación que permita copiar y pegar imágenes desde el portapapeles utilizando botones. Muestra las imágenes pegadas en un QLabel.
3.	### Notificación de Cambios
- Implementa un programa que muestre una notificación cada vez que el contenido del portapapeles cambie, ya sea texto o imagen. Usa la señal changed() para detectar los cambios.
4.	### Limpiar Portapapeles
- Agrega una funcionalidad a tu aplicación para limpiar el contenido del portapapeles con un botón y muestra un mensaje en la consola cuando el portapapeles ha sido limpiado.

***

QClipboard es una herramienta poderosa para integrar las operaciones de copiar y pegar en tu aplicación, permitiendo compartir datos fácilmente entre diferentes aplicaciones o componentes.

