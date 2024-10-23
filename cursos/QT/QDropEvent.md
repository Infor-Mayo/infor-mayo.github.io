---
layout: cabeza3
---

# Clase QDropEvent
QDropEvent es una clase en Qt que gestiona los eventos relacionados con el arrastre y la suelta (drag and drop) de datos en un widget. Se utiliza cuando los usuarios sueltan datos arrastrados en un widget que acepta este tipo de acciones. Contiene información sobre el contenido que se está soltando, como el tipo de datos, las acciones permitidas y la posición donde se sueltan.
***
## Características Principales de QDropEvent
- Interacción con operaciones de arrastre y suelta: Permite obtener información sobre los datos soltados, las acciones permitidas, y la posición exacta de la suelta.
- Compatibilidad con múltiples formatos MIME: Los datos que se arrastran pueden estar en varios formatos, como texto, imágenes, archivos, etc.
- Soporte para operaciones de copiar, mover y enlace: Permite realizar varias acciones al soltar los datos, dependiendo de cómo se haya configurado la operación de arrastre.
***
## Métodos Principales de QDropEvent
1. ### QMimeData *mimeData() const
    Devuelve un puntero al objeto QMimeData, que contiene los datos que se están soltando.
    - Retorno: Un puntero a QMimeData, donde están los datos transferidos.
    
    Ejemplo:
    ```cpp
    QMimeData *data = event->mimeData();
    if (data->hasText()) {
        QString text = data->text();
    }
    ```
2. ### Qt::DropAction dropAction() const
    Devuelve la acción de soltado que se llevará a cabo. Esto puede ser copiar, mover, o enlazar los datos.
    - Retorno: Un valor de tipo Qt::DropAction (por ejemplo, Qt::CopyAction o Qt::MoveAction).
    
    Ejemplo:
    ```cpp
    Qt::DropAction action = event->dropAction();
    if (action == Qt::CopyAction) {
        // Realizar acción de copiar
    }
    ```
3. ### Qt::DropActions possibleActions() const
    Devuelve las acciones de soltado posibles para la operación actual (copiar, mover, enlazar).
    - Retorno: Un valor de tipo Qt::DropActions.
    
    Ejemplo:
    ```cpp
    if (event->possibleActions() & Qt::MoveAction) {
        // Realizar la acción de mover
    }
    ```
4. ### Qt::KeyboardModifiers keyboardModifiers() const
    Devuelve los modificadores del teclado que estaban activos durante el evento de soltado (por ejemplo, Ctrl, Shift, etc.).
    - Retorno: Un valor de tipo Qt::KeyboardModifiers.
    
    Ejemplo:
    ```cpp
    if (event->keyboardModifiers() & Qt::ControlModifier) {
        // El usuario mantuvo presionada la tecla Ctrl
    }
    ```
5. ### Qt::MouseButtons mouseButtons() const
    Devuelve los botones del ratón que estaban activos durante el evento de soltado.
    - Retorno: Un valor de tipo Qt::MouseButtons.
    
    Ejemplo:
    ```cpp
    if (event->mouseButtons() & Qt::LeftButton) {
        // Se soltó con el botón izquierdo del ratón
    }
    ```
6. ### QPoint pos() const
    Devuelve la posición del cursor del ratón donde se soltaron los datos, relativa al widget receptor.
    - Retorno: Un valor de tipo QPoint.
    
    Ejemplo:
    ```cpp
    QPoint dropPos = event->pos();
    ```
7. ### QPointF posF() const
    Devuelve la posición del cursor del ratón donde se soltaron los datos como un valor de punto flotante, relativa al widget receptor.
    - Retorno: Un valor de tipo QPointF.
    
    Ejemplo:
    ```cpp
    QPointF dropPosF = event->posF();
    ```
8. ### Qt::DropAction proposedAction() const
    Devuelve la acción propuesta que se llevará a cabo durante el evento de soltado, que puede ser copiar, mover o enlazar.
    - Retorno: Un valor de tipo Qt::DropAction.
    
    Ejemplo:
    ```cpp
    Qt::DropAction proposed = event->proposedAction();
    ```
***
## Ejemplo Completo
En este ejemplo, se implementa un widget que acepta datos de texto soltados en él.
```cpp
#include <QApplication>
#include <QWidget>
#include <QLabel>
#include <QVBoxLayout>
#include <QDropEvent>
#include <QMimeData>
#include <QDragEnterEvent>

class DropLabel : public QLabel {
public:
    DropLabel(QWidget *parent = nullptr) : QLabel(parent) {
        setText("Arrastra texto aquí");
        setAlignment(Qt::AlignCenter);
        setAcceptDrops(true); // Permitir que se acepten eventos de arrastrar y soltar
        setStyleSheet("background-color: lightgray; border: 2px dashed black;");
    }

protected:
    void dragEnterEvent(QDragEnterEvent *event) override {
        if (event->mimeData()->hasText()) {
            event->acceptProposedAction();  // Aceptar solo si los datos contienen texto
        }
    }

    void dropEvent(QDropEvent *event) override {
        setText(event->mimeData()->text());  // Obtener el texto del objeto QMimeData
        event->acceptProposedAction();
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout *layout = new QVBoxLayout(&window);
    DropLabel *dropLabel = new DropLabel(&window);

    layout->addWidget(dropLabel);

    window.setWindowTitle("Ejemplo de QDropEvent");
    window.resize(300, 200);
    window.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Arrastrar y soltar imágenes
- Implementa un widget que permita arrastrar imágenes desde un explorador de archivos o desde otro widget. Usa QDropEvent y QMimeData para gestionar las imágenes arrastradas y actualiza el widget receptor para mostrar la imagen
2.	### Soltar archivos y mostrar su contenido
- Implementa una aplicación que acepte archivos de texto arrastrados sobre un QLabel y, al soltarlos, muestre su contenido en el widget.
3.	### Implementar operaciones condicionales de arrastrar y soltar
- Crea un widget que permita arrastrar elementos con distintas acciones: copiar, mover o enlazar. Configura el evento de soltado (QDropEvent) para que se realice la acción adecuada dependiendo de las teclas modificadoras (Ctrl, Shift, etc.) presionadas durante la operación de arrastre.

