---
layout: cabeza3
---

# Clase QMimeData
La clase QMimeData en Qt es utilizada para encapsular datos que pueden ser transferidos mediante operaciones de arrastrar y soltar (drag and drop), el portapapeles o las operaciones de copiar y pegar. Los datos se almacenan en varios formatos, como texto, imágenes, URLs, o cualquier formato MIME personalizado.
QMimeData soporta una amplia gama de tipos de datos predefinidos, y también te permite definir tus propios tipos de datos personalizados.
***
## Características Principales
- Transferencia de datos multi-formato: Permite almacenar y transferir datos en múltiples formatos (texto, HTML, imágenes, archivos, etc.).
- Uso en arrastrar y soltar: Es la clase base para enviar datos en operaciones de arrastrar y soltar.
- Soporte para el portapapeles: Interactúa con el portapapeles del sistema, facilitando las operaciones de copiar y pegar.
- Definición de formatos personalizados: Permite agregar datos en cualquier formato definido por el usuario.
***
## Métodos Principales de QMimeData
1. ### void setText(const QString &text)
    Establece los datos MIME como texto.

    Parámetros:
    - text: El texto que será encapsulado dentro del objeto QMimeData.

    Ejemplo:
    ```cpp
    QMimeData *mimeData = new QMimeData;
    mimeData->setText("Texto a transferir");
    ```
2. ### QString text() const
    Devuelve el texto almacenado en el objeto QMimeData.
    - Retorno: El texto encapsulado.

    Ejemplo:
    ```cpp
    QString retrievedText = mimeData->text();
    ```
3. ### void setHtml(const QString &html)
    Establece el contenido como HTML. Útil cuando se desea transferir contenido HTML formateado.

    Parámetros:
    - html: La cadena que contiene el contenido en formato HTML.

    Ejemplo:
    ```cpp
    mimeData->setHtml("<h1>Título en HTML</h1><p>Texto de ejemplo.</p>");
    ```
4. ### QString html() const
    Devuelve el contenido HTML almacenado en QMimeData.
    - Retorno: Una cadena que contiene los datos en formato HTML.

    Ejemplo:
    ```cpp
    QString retrievedHtml = mimeData->html();
    ```
5. ### void setUrls(const QList<QUrl> &urls)
    Establece una lista de URLs para ser transferidas.

    Parámetros:
    - urls: Una lista de objetos QUrl que contiene las URLs a transferir.

    Ejemplo:
    ```cpp
    QList<QUrl> urlList;
    urlList.append(QUrl("http://www.qt.io"));
    mimeData->setUrls(urlList);
    ```
6. ## QList<QUrl> urls() const
    Devuelve la lista de URLs almacenada en QMimeData.
    - Retorno: Una lista de objetos QUrl.

    Ejemplo:
    ```cpp
    QList<QUrl> retrievedUrls = mimeData->urls();
    ```
7. ## void setImageData(const QVariant &image)
    Establece los datos MIME como una imagen. Se usa para transferir imágenes.

    Parámetros:
    - image: Un QVariant que contiene la imagen (generalmente un QPixmap o QImage).

    Ejemplo:
    ```cpp
    QImage image(":/path/to/image.png");
    mimeData->setImageData(image);
    ```
8. ### QVariant imageData() const
    Devuelve los datos de imagen almacenados en QMimeData.
    - Retorno: Un QVariant que contiene la imagen.

    Ejemplo:
    ```cpp
    QVariant retrievedImage = mimeData->imageData();
    ```
9. ### void setData(const QString &mimeType, const QByteArray &data)
    Establece datos en un formato MIME personalizado.

    Parámetros:
    - mimeType: El tipo MIME de los datos.
    - data: Los datos a transferir, encapsulados en un QByteArray.

    Ejemplo:
    ```cpp
    QByteArray customData = QByteArray("Datos personalizados");
    mimeData->setData("application/custom-type", customData);
    ```
10. ### QByteArray data(const QString &mimeType) const
    Devuelve los datos almacenados bajo el tipo MIME especificado.

    Parámetros:
    - mimeType: El tipo MIME para el cual se solicitan los datos.
    - Retorno: Los datos almacenados en un QByteArray.

    Ejemplo:
    ```cpp
    QByteArray retrievedData = mimeData->data("application/custom-type");
    ```
11. ### bool hasText() const
    Devuelve true si el objeto contiene datos de tipo texto.

    Ejemplo:
    ```cpp
    if (mimeData->hasText()) {
        QString text = mimeData->text();
    }
    ```
12. ### bool hasHtml() const
    Devuelve true si el objeto contiene datos en formato HTML.

    Ejemplo:
    ```cpp
    if (mimeData->hasHtml()) {
        QString html = mimeData->html();
    }
    ```
13. ### bool hasUrls() const
    Devuelve true si el objeto contiene URLs.
    Ejemplo:
    ```cpp
    if (mimeData->hasUrls()) {
        QList<QUrl> urls = mimeData->urls();
    }
    ```
14. ### bool hasImage() const
    Devuelve true si el objeto contiene datos de imagen.

    Ejemplo:
    ```cpp
    if (mimeData->hasImage()) {
        QVariant image = mimeData->imageData();
    }
    ```
***
## Ejemplo Completo
A continuación, un ejemplo de cómo usar QMimeData para implementar una operación de arrastrar y soltar texto entre widgets.
```cpp
#include <QApplication>
#include <QLabel>
#include <QMimeData>
#include <QDrag>
#include <QDropEvent>
#include <QDragEnterEvent>
#include <QVBoxLayout>
#include <QWidget>

class DraggableLabel : public QLabel {
public:
    DraggableLabel(const QString &text, QWidget *parent = nullptr) : QLabel(text, parent) {
        setAlignment(Qt::AlignCenter);
        setStyleSheet("background-color: lightblue;");
    }

protected:
    void mousePressEvent(QMouseEvent *event) override {
        if (event->button() == Qt::LeftButton) {
            QDrag *drag = new QDrag(this);
            QMimeData *mimeData = new QMimeData;
            mimeData->setText(text());
            drag->setMimeData(mimeData);
            drag->exec(Qt::CopyAction);
        }
    }
};

class DropLabel : public QLabel {
public:
    DropLabel(QWidget *parent = nullptr) : QLabel(parent) {
        setAcceptDrops(true);
        setText("Arrastra texto aquí");
        setAlignment(Qt::AlignCenter);
        setStyleSheet("background-color: lightgray; border: 2px dashed black;");
    }

protected:
    void dragEnterEvent(QDragEnterEvent *event) override {
        if (event->mimeData()->hasText()) {
            event->acceptProposedAction();
        }
    }

    void dropEvent(QDropEvent *event) override {
        setText(event->mimeData()->text());
        event->acceptProposedAction();
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout *layout = new QVBoxLayout(&window);
    DraggableLabel *draggable = new DraggableLabel("Arrastra este texto", &window);
    DropLabel *dropLabel = new DropLabel(&window);

    layout->addWidget(draggable);
    layout->addWidget(dropLabel);

    window.show();
    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Implementar arrastrar y soltar imágenes
- Crea una aplicación que permita arrastrar imágenes desde un QLabel a otro QLabel usando QMimeData y QImage.
2.	### Crear una lista de URLs arrastrables
- Implementa una aplicación que permita arrastrar una lista de URLs desde un QListWidget hacia otro widget o aplicación externa.
3.	### Operaciones de copiar y mover
- Crea una aplicación que permita arrastrar texto entre dos widgets, pero con soporte tanto para copiar como para mover el texto dependiendo de si el usuario mantiene presionada la tecla Ctrl.
4.	### Uso de datos personalizados
- Implementa una aplicación que permita arrastrar datos en un formato MIME personalizado. Asegúrate de poder definir y recuperar estos datos en un formato binario como QByteArray.

