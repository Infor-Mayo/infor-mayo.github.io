---
layout: cabeza3
---

# Clase QEvent
QEvent es una clase base en Qt que representa eventos y señales emitidas por varios objetos durante la ejecución de una aplicación. Todos los eventos en Qt derivan de QEvent, lo que significa que manejar eventos de diferentes tipos implica trabajar con esta clase. Los eventos permiten que las aplicaciones reaccionen a interacciones del usuario (como clics del ratón o pulsaciones de teclas), cambios del sistema o eventos personalizados.
Tipos de Eventos

Qt define muchos tipos de eventos predefinidos, como eventos de ratón, teclado, temporizador, ventanas y más. Estos tipos se identifican mediante el campo type() de la clase QEvent, que devuelve una enumeración del tipo QEvent::Type.
Principales Tipos de Eventos

Algunos de los eventos más comunes que puedes manejar en una aplicación Qt incluyen:
1.	QMouseEvent: Eventos del ratón.
2.	QKeyEvent: Eventos de teclado.
3.	QTimerEvent: Eventos de temporizador.
4.	QResizeEvent: Eventos de cambio de tamaño de ventanas.
5.	QPaintEvent: Eventos relacionados con el repintado de un widget.
6.	QCloseEvent: Evento emitido cuando una ventana está a punto de cerrarse.
7.	QFocusEvent: Evento cuando un widget gana o pierde el foco.

Sintaxis
```cpp
class QEvent
{
public:
    explicit QEvent(Type type);
    virtual ~QEvent();
    
    Type type() const;
    static int registerEventType(int hint = -1);
};
```
## Métodos Importantes
- QEvent::QEvent(Type type): Constructor que inicializa el evento con un tipo específico.
- QEvent::type() const: Devuelve el tipo del evento (como QEvent::MouseButtonPress, QEvent::KeyPress, etc.).
- QEvent::registerEventType(int hint = -1): Permite registrar un nuevo tipo de evento personalizado.
Principales Enumeraciones
La enumeración QEvent::Type incluye muchos valores predefinidos. Algunos de los más comunes son:
- QEvent::MouseButtonPress: Evento de presión de un botón del ratón.
- QEvent::MouseButtonRelease: Evento de liberación de un botón del ratón.
- QEvent::KeyPress: Evento de presión de una tecla.
- QEvent::KeyRelease: Evento de liberación de una tecla.
- QEvent::Timer: Evento generado por un temporizador.
- QEvent::FocusIn: Evento cuando un widget gana el foco.
- QEvent::FocusOut: Evento cuando un widget pierde el foco.
- QEvent::Resize: Evento cuando se cambia el tamaño de un widget.
- QEvent::Close: Evento que indica que una ventana está cerrándose.
***
## Uso de QEvent en la Sobrecarga de event()
Para manejar eventos en tus widgets, puedes sobrecargar el método event() en cualquier clase que herede de QObject o QWidget. Dentro de event(), puedes interceptar y manejar los eventos en función de su tipo.

Ejemplo de Sobrecarga de event() para Manejar Eventos de Teclado y Ratón:
```cpp
#include <QApplication>
#include <QWidget>
#include <QKeyEvent>
#include <QMouseEvent>
#include <QDebug>

class MyWidget : public QWidget
{
protected:
    bool event(QEvent *event) override {
        if (event->type() == QEvent::KeyPress) {
            QKeyEvent *keyEvent = static_cast<QKeyEvent*>(event);
            qDebug() << "Tecla presionada:" << keyEvent->text();
            return true; // Indicar que el evento fue manejado
        }
        else if (event->type() == QEvent::MouseButtonPress) {
            QMouseEvent *mouseEvent = static_cast<QMouseEvent*>(event);
            qDebug() << "Botón del ratón presionado en posición:" << mouseEvent->pos();
            return true; // Indicar que el evento fue manejado
        }
        return QWidget::event(event);  // Pasar otros eventos al manejador por defecto
    }
};

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    MyWidget window;
    window.show();

    return app.exec();
}
```
En este ejemplo, el widget intercepta los eventos de teclado (QKeyEvent) y de ratón (QMouseEvent) y los maneja dentro del método event().
***
## Crear Eventos Personalizados
Además de los eventos predefinidos en Qt, puedes definir tus propios eventos personalizados. Esto es útil si tu aplicación necesita enviar información específica a través de eventos.

Pasos para Crear un Evento Personalizado:
1.	Registra un nuevo tipo de evento utilizando QEvent::registerEventType().
2.	Crea una subclase de QEvent para almacenar datos adicionales que se enviarán con el evento.
3.	Envía el evento usando QCoreApplication::postEvent() o QWidget::event().

Ejemplo de Evento Personalizado:
```cpp
#include <QApplication>
#include <QWidget>
#include <QEvent>
#include <QDebug>

class CustomEvent : public QEvent
{
public:
    static const QEvent::Type CustomType = static_cast<QEvent::Type>(QEvent::registerEventType());

    CustomEvent(int value) : QEvent(CustomType), data(value) {}

    int getData() const { return data; }

private:
    int data;
};

class MyWidget : public QWidget
{
protected:
    void customEvent(QEvent *event) override {
        if (event->type() == CustomEvent::CustomType) {
            CustomEvent *customEvent = static_cast<CustomEvent*>(event);
            qDebug() << "Evento personalizado recibido con dato:" << customEvent->getData();
        }
    }

public:
    void sendCustomEvent() {
        CustomEvent *event = new CustomEvent(42);
        QCoreApplication::postEvent(this, event);  // Enviar evento personalizado
    }
};

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    MyWidget window;
    window.show();

    window.sendCustomEvent();  // Enviar evento personalizado al inicio

    return app.exec();
}
```
En este ejemplo, creamos un evento personalizado que contiene un entero como dato adicional. Este evento se envía al widget mediante QCoreApplication::postEvent() y se maneja en el método customEvent().
***
## Ejercicios de Consolidación
1.	### Manejo de Eventos de Teclado: 
- Implementa una aplicación que detecte cuando se presionan teclas específicas y muestre un mensaje en la consola.
2.	### Manejo de Eventos de Ratón: 
- Crea una aplicación donde al hacer clic en diferentes áreas de una ventana se realicen diferentes acciones, como cambiar el color de fondo.
3.	### Evento de Temporizador: 
- Implementa una aplicación que use eventos de temporizador para actualizar un contador en pantalla cada segundo.
4.	### Evento Personalizado: 
- Crea un evento personalizado que transporte una cadena de texto. Usa este evento para comunicar información entre diferentes widgets.
***
Estos ejemplos y ejercicios te ayudarán a consolidar el manejo de eventos en Qt utilizando la clase QEvent y sus derivados.

