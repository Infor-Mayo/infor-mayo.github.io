---
layout: cabeza3
---

# Clase QMouseEvent
QMouseEvent es una clase en Qt que representa eventos generados por la interacción del ratón. Esta clase se utiliza para manejar los eventos como presiones y liberaciones de botones del ratón, así como los movimientos y la interacción con la rueda del ratón.

Los eventos de ratón son comunes en las interfaces gráficas y permiten que las aplicaciones respondan a acciones del usuario. Los eventos típicos incluyen clics de botones, movimientos del cursor y la interacción con la rueda del ratón.
***
## Herencia
QMouseEvent hereda de la clase base QInputEvent, que a su vez hereda de QEvent. Esto significa que QMouseEvent comparte métodos comunes para manejar los eventos de entrada.
***
## Tipos de Eventos de Ratón
Algunos de los eventos relacionados con el ratón incluyen:
- QEvent::MouseButtonPress: Se emite cuando se presiona un botón del ratón.
- QEvent::MouseButtonRelease: Se emite cuando se libera un botón del ratón.
- QEvent::MouseMove: Se emite cuando se mueve el ratón.
- QEvent::MouseButtonDblClick: Se emite cuando se hace doble clic con un botón del ratón.
## Sintaxis
```cpp
class QMouseEvent : public QInputEvent
{
public:
    QMouseEvent(Type type, const QPointF &localPos, const QPointF &screenPos, 
                Qt::MouseButton button, Qt::MouseButtons buttons, 
                Qt::KeyboardModifiers modifiers);
    
    QPoint pos() const;
    QPointF localPos() const;
    QPointF screenPos() const;
    QPointF windowPos() const;
    Qt::MouseButton button() const;
    Qt::MouseButtons buttons() const;
    Qt::KeyboardModifiers modifiers() const;
    bool source() const;
};
```
## Métodos Importantes
1. ### QPoint pos() const
    - Devuelve la posición del ratón en coordenadas enteras relativas al widget que recibió el evento.
2. ### QPointF localPos() const
    - Devuelve la posición local del cursor del ratón en coordenadas flotantes relativas al widget que recibió el evento.
3. ### QPointF screenPos() const
    - Devuelve la posición del cursor en la pantalla en coordenadas flotantes, relativas a toda la pantalla.
4. ### QPointF windowPos() const
    - Devuelve la posición del cursor del ratón en coordenadas flotantes relativas a la ventana que contiene el widget que recibió el evento.
5. ### Qt::MouseButton button() const
    - Devuelve el botón del ratón que se presionó o liberó (por ejemplo, Qt::LeftButton, Qt::RightButton, etc.).
6. ### Qt::MouseButtons buttons() const
    - Devuelve una combinación de botones que estaban presionados en el momento en que ocurrió el evento. Esto permite conocer si varios botones del ratón estaban presionados simultáneamente.
7. ### Qt::KeyboardModifiers modifiers() const
    - Devuelve una combinación de teclas modificadoras que estaban activas cuando ocurrió el evento, como Qt::ShiftModifier, Qt::ControlModifier, etc.
8. ### bool source() const
    - Indica el origen del evento de entrada. Puede ser de diferentes tipos, como táctil, ratón, etc.
9. ### void accept()
    - Marca el evento como aceptado, lo que significa que no se pasará a otros widgets.
10. ### void ignore()
    - Marca el evento como ignorado, lo que significa que puede ser procesado por otros widgets.
***
## Ejemplo Básico de Uso de QMouseEvent
A continuación, se muestra cómo manejar un evento de ratón en un widget:
```cpp
#include <QApplication>
#include <QWidget>
#include <QMouseEvent>
#include <QDebug>

class MyWidget : public QWidget
{
protected:
    void mousePressEvent(QMouseEvent *event) override {
        if (event->button() == Qt::LeftButton) {
            qDebug() << "Clic izquierdo en posición:" << event->pos();
        } else if (event->button() == Qt::RightButton) {
            qDebug() << "Clic derecho en posición:" << event->pos();
        }
    }

    void mouseMoveEvent(QMouseEvent *event) override {
        qDebug() << "Ratón movido a:" << event->pos();
    }

    void mouseReleaseEvent(QMouseEvent *event) override {
        qDebug() << "Botón del ratón liberado en posición:" << event->pos();
    }

    void mouseDoubleClickEvent(QMouseEvent *event) override {
        qDebug() << "Doble clic en posición:" << event->pos();
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
- mousePressEvent(): Se maneja cuando el usuario hace clic con el ratón.
- mouseMoveEvent(): Se detecta el movimiento del ratón.
- mouseReleaseEvent(): Se maneja cuando el usuario suelta un botón del ratón.
- mouseDoubleClickEvent(): Se maneja cuando el usuario hace doble clic.
***
## Ejercicios de Consolidación
1.	### Dibujar Círculos con el Ratón: 
    - Crea una aplicación que dibuje un círculo en la posición donde el usuario hace clic con el ratón.
2.	### Mover un Objeto con el Ratón: 
    - Implementa una aplicación donde el usuario pueda hacer clic en un objeto en la pantalla y arrastrarlo con el ratón.
3.	### Juego del Doble Clic: 
    - Crea una aplicación que responda solo a dobles clics, y cuente cuántos dobles clics ha recibido el widget.
4.	### Resaltar al Pasar el Ratón: 
    - Implementa un widget que cambie de color cuando el ratón pase sobre él (usando mouseMoveEvent()).
***
Estos ejercicios permiten profundizar en el manejo de los eventos de ratón y el uso de la clase QMouseEvent en aplicaciones gráficas con Qt.

