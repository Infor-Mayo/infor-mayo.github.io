---
layout: cabeza3
---

# Clase QDrag
QDrag es una clase de Qt utilizada para implementar operaciones de arrastrar y soltar (drag and drop). Con QDrag, puedes arrastrar un objeto desde un origen (por ejemplo, un widget) y soltarlo en otro destino (otro widget o área dentro de la misma aplicación o incluso en otras aplicaciones).

El proceso de arrastrar y soltar implica varias partes: un origen de arrastre, los datos a arrastrar, y un destino que acepta los datos. QDrag se encarga de gestionar el comportamiento de la operación de arrastre.
***
## Características Principales
- Gestión de arrastrar y soltar: Facilita la implementación del arrastre de datos entre diferentes widgets o incluso aplicaciones.
- Soporte de múltiples tipos de datos: Permite el arrastre de texto, imágenes, archivos, y otros tipos de datos a través de QMimeData.
- Integración visual: Permite agregar iconos o indicadores visuales durante la operación de arrastre.
***
## Métodos Principales de QDrag
1. ### QDrag(QObject *source)
    Constructor que crea un objeto QDrag con el origen del arrastre.
    
    Parámetros:
    - source: El objeto que iniciará la operación de arrastre.
    
    Ejemplo:
    ```cpp
    QDrag *drag = new QDrag(this);  // El objeto que será arrastrado desde 'this'
    ```
2. ### void setMimeData(QMimeData *data)
    Establece los datos que serán arrastrados. Los datos se encapsulan en un objeto QMimeData.
    
    Parámetros:
    - data: Los datos que serán arrastrados, representados en un objeto QMimeData.
    
    Ejemplo:
    ```cpp
    QMimeData *mimeData = new QMimeData;
    mimeData->setText("Texto arrastrado");
    drag->setMimeData(mimeData);
    ```
3. ### void setPixmap(const QPixmap &pixmap)
    Establece el icono o imagen que se mostrará durante la operación de arrastre.
    
    Parámetros:
    - pixmap: La imagen que se mostrará durante el arrastre.
    
    Ejemplo:
    ```cpp
    QPixmap pixmap(":/images/icon.png");
    drag->setPixmap(pixmap);
    ```
4. ### void setHotSpot(const QPoint &hotspot)
    Establece el punto exacto (hotspot) dentro de la imagen del pixmap donde el cursor debe estar ubicado durante la operación de arrastre.
    
    Parámetros:
    - hotspot: El punto en el pixmap que sigue al cursor durante el arrastre.
   
    Ejemplo:
    ```cpp
    drag->setHotSpot(QPoint(pixmap.width()/2, pixmap.height()/2));  // Centra el cursor en el icono
    ```
5. ### Qt::DropAction exec(Qt::DropActions supportedActions = Qt::MoveAction)
    Inicia la operación de arrastre y devuelve el tipo de acción de soltar que se realizó. El método es bloqueante y devuelve cuando la operación ha terminado.
    
    Parámetros:
    - supportedActions: Indica qué acciones de soltar están permitidas (Qt::CopyAction, Qt::MoveAction, Qt::LinkAction).
    
    Ejemplo:
    ```cpp
    Qt::DropAction result = drag->exec(Qt::CopyAction | Qt::MoveAction);
    ```
***
## Uso de QDrag con QMimeData
Para realizar una operación de arrastre, primero se debe crear un objeto QMimeData que contenga los datos que serán arrastrados (como texto, imágenes, URLs, etc.). Luego, se crea el objeto QDrag, se le asigna el QMimeData, y finalmente se llama a exec() para iniciar la operación de arrastre.
***
## Ejemplo Completo
Aquí se muestra cómo crear una aplicación que permita arrastrar texto desde un QLabel hacia otro widget:
```cpp
#include <QApplication>
#include <QLabel>
#include <QDrag>
#include <QMimeData>
#include <QVBoxLayout>
#include <QWidget>
#include <QDropEvent>
#include <QDragEnterEvent>
#include <QDragMoveEvent>

class DropLabel : public QLabel {
public:
    DropLabel(QWidget *parent = nullptr) : QLabel(parent) {
        setAcceptDrops(true);
        setText("Arrastra texto aquí");
        setAlignment(Qt::AlignCenter);
        setStyleSheet("QLabel { background-color : lightgray; border: 2px dashed gray; }");
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

class DraggableLabel : public QLabel {
public:
    DraggableLabel(const QString &text, QWidget *parent = nullptr) : QLabel(text, parent) {
        setAlignment(Qt::AlignCenter);
        setStyleSheet("QLabel { background-color : lightblue; border: 1px solid black; }");
    }

protected:
    void mousePressEvent(QMouseEvent *event) override {
        if (event->button() == Qt::LeftButton) {
            QDrag *drag = new QDrag(this);
            QMimeData *mimeData = new QMimeData;
            mimeData->setText(text());
            drag->setMimeData(mimeData);
            drag->exec(Qt::CopyAction | Qt::MoveAction);
        }
    }
};

class DragDropWidget : public QWidget {
public:
    DragDropWidget() {
        QVBoxLayout *layout = new QVBoxLayout(this);
        DraggableLabel *draggable = new DraggableLabel("Arrastra este texto", this);
        DropLabel *dropLabel = new DropLabel(this);
        layout->addWidget(draggable);
        layout->addWidget(dropLabel);
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    DragDropWidget window;
    window.show();

    return app.exec();
}

#include "main.moc"
```
***
## Ejercicios de Consolidación
1.	### Arrastrar y soltar imágenes
- Crea una aplicación que permita arrastrar imágenes desde un QLabel y soltarlas en otro QLabel. Usa QPixmap para representar las imágenes y QMimeData para contener los datos de las imágenes.
2.	### Arrastrar texto entre diferentes widgets
- Implementa una aplicación que permita arrastrar texto desde un QTextEdit y soltarlo en un QLineEdit. Asegúrate de aceptar solo texto en el QLineEdit.
3.	### Operaciones de mover y copiar
- Crea una aplicación que permita arrastrar elementos entre dos listas (QListWidget). Implementa tanto la acción de copiar como la de mover los elementos arrastrados, dependiendo de si se presiona Ctrl o no durante la operación.
4.	### Múltiples formatos de datos
- Crea una aplicación que permita arrastrar y soltar diferentes tipos de datos, como texto e imágenes, usando QMimeData.

