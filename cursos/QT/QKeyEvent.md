---
layout: cabeza3
---

# Clase QKeyEvent
QKeyEvent es la clase en Qt que representa eventos generados por el teclado. Esta clase se utiliza para capturar y manejar eventos como la presión o liberación de teclas en un teclado. Los eventos de teclado son esenciales para muchas aplicaciones que dependen de la interacción del usuario para realizar acciones.
Algunos de los eventos de teclado más comunes son la presión de una tecla (QEvent::KeyPress) y la liberación de una tecla (QEvent::KeyRelease).
## Herencia
QKeyEvent hereda de la clase base QInputEvent, que a su vez hereda de QEvent. Esto significa que QKeyEvent comparte métodos y propiedades de eventos de entrada.
## Sintaxis
```cpp
class QKeyEvent : public QInputEvent
{
public:
    QKeyEvent(Type type, int key, Qt::KeyboardModifiers modifiers, const QString &text = QString(), 
              bool autorep = false, ushort count = 1);
    
    int key() const;
    Qt::KeyboardModifiers modifiers() const;
    QString text() const;
    bool isAutoRepeat() const;
    int count() const;
};
```
## Métodos Importantes
1. int key() const
- Devuelve el código de la tecla que fue presionada o liberada. Este valor es de tipo Qt::Key, una enumeración que incluye valores como Qt::Key_A, Qt::Key_Enter, etc.
2. Qt::KeyboardModifiers modifiers() const
- Devuelve las teclas modificadoras que estaban activas cuando se produjo el evento. Las teclas modificadoras son como Qt::ShiftModifier, Qt::ControlModifier, y Qt::AltModifier.
3. QString text() const
- Devuelve el carácter generado por la tecla presionada. Esto es útil cuando se necesita el carácter real que se ingresó, en lugar del código de la tecla.
4. bool isAutoRepeat() const
- Devuelve true si el evento fue generado por la repetición automática de la tecla cuando se mantiene presionada durante un tiempo prolongado.
5. int count() const
- Devuelve el número de veces que la tecla ha sido registrada. Esto es útil en algunos casos cuando se maneja la repetición de teclas.
***
## Ejemplo Básico de Uso de QKeyEvent
A continuación, se muestra cómo manejar un evento de teclado en un widget:
```cpp
#include <QApplication>
#include <QWidget>
#include <QKeyEvent>
#include <QDebug>

class MyWidget : public QWidget
{
protected:
    void keyPressEvent(QKeyEvent *event) override {
        if (event->key() == Qt::Key_A) {
            qDebug() << "Tecla 'A' presionada.";
        } else if (event->key() == Qt::Key_Escape) {
            qDebug() << "Tecla 'Escape' presionada.";
        }
        QWidget::keyPressEvent(event);
    }

    void keyReleaseEvent(QKeyEvent *event) override {
        qDebug() << "Tecla liberada:" << event->text();
    }
};

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    MyWidget window;
    window.resize(400, 300);
    window.show();

    return app.exec();
}
```
En este ejemplo:
- keyPressEvent(): Se captura el evento cuando el usuario presiona una tecla. En el código, se detecta si se presiona la tecla 'A' o 'Escape'.
- keyReleaseEvent(): Se detecta cuando se libera una tecla, y se imprime el carácter correspondiente.
***
## Detectar Combinaciones de Teclas con Modificadores
Puedes detectar combinaciones de teclas, como Ctrl+C, verificando las teclas modificadoras en conjunto con las teclas normales. Un ejemplo común es manejar atajos de teclado como Ctrl+C o Ctrl+V.
```cpp
void keyPressEvent(QKeyEvent *event) override {
    if (event->modifiers() == Qt::ControlModifier && event->key() == Qt::Key_C) {
        qDebug() << "Ctrl+C presionado.";
    } else if (event->modifiers() == Qt::ControlModifier && event->key() == Qt::Key_V) {
        qDebug() << "Ctrl+V presionado.";
    }
}
```
Este código maneja la combinación Ctrl+C y Ctrl+V, lo cual es común en aplicaciones para copiar y pegar.
***
## Método text() para Capturar el Carácter Ingresado
El método text() devuelve el carácter que fue generado por la tecla presionada. Este carácter depende de la configuración de idioma del teclado, y es útil cuando el usuario escribe texto.
```cpp
void keyPressEvent(QKeyEvent *event) override {
    qDebug() << "Tecla presionada, carácter:" << event->text();
}
```
Por ejemplo, si el usuario presiona la tecla 'A', text() devolverá "a", y si presiona Shift+A, devolverá "A".
***
## Eventos de Repetición Automática
Algunas teclas generan eventos repetidos cuando se mantienen presionadas durante un período de tiempo. Para detectar si un evento es una repetición automática, puedes usar el método isAutoRepeat().
```cpp
void keyPressEvent(QKeyEvent *event) override {
    if (event->isAutoRepeat()) {
        qDebug() << "Repetición automática de la tecla:" << event->key();
    } else {
        qDebug() << "Tecla presionada:" << event->key();
    }
}
```
***
## Ejemplo Completo
Aquí tienes un ejemplo más completo que detecta varias teclas, combinaciones de teclas, y caracteres.
```cpp
#include <QApplication>
#include <QWidget>
#include <QKeyEvent>
#include <QDebug>

class MyWidget : public QWidget
{
protected:
    void keyPressEvent(QKeyEvent *event) override {
        if (event->key() == Qt::Key_A) {
            qDebug() << "Tecla 'A' presionada.";
        }
        else if (event->modifiers() == Qt::ControlModifier && event->key() == Qt::Key_C) {
            qDebug() << "Ctrl+C presionado.";
        }
        else if (event->isAutoRepeat()) {
            qDebug() << "Repetición automática de tecla:" << event->key();
        } else {
            qDebug() << "Otra tecla presionada:" << event->key();
        }
    }

    void keyReleaseEvent(QKeyEvent *event) override {
        qDebug() << "Tecla liberada:" << event->text();
    }
};

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    MyWidget window;
    window.resize(400, 300);
    window.show();

    return app.exec();
}
```
En este ejemplo, se detectan teclas simples como 'A', combinaciones de teclas como Ctrl+C, y eventos de repetición automática.
***
Ejercicios de Consolidación
1.	Contador de Teclas: 
- Implementa una aplicación que cuente cuántas veces se ha presionado cada tecla. Imprime el conteo total al final.
2.	Atajos de Teclado: 
- Crea una aplicación que maneje atajos de teclado como Ctrl+N para crear un nuevo documento y Ctrl+S para guardar.
3.	Aplicación de Edición de Texto: 
- Implementa una pequeña aplicación de edición de texto que permita al usuario escribir texto en un área de texto y detecte ciertas combinaciones de teclas para realizar acciones (por ejemplo, Ctrl+B para poner texto en negrita).
4.	Juego con el Teclado: 
- Crea un juego simple donde el usuario controle un objeto en pantalla usando las teclas de flechas (Qt::Key_Up, Qt::Key_Down, etc.).
***
Estos ejercicios te ayudarán a consolidar el manejo de eventos de teclado con QKeyEvent en aplicaciones Qt.

