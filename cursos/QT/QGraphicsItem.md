---
layout: cabeza3
---

# Clase QGraphicsItem
QGraphicsItem es la clase base de la que heredan todos los objetos gráficos que pueden añadirse a una escena QGraphicsScene. Define las propiedades y comportamientos básicos de los elementos gráficos, como su forma, posición, transformación y respuesta a eventos. Para crear objetos personalizados, normalmente se hereda de esta clase y se sobrescriben algunos de sus métodos.
***
## Características Principales
- Representa un elemento gráfico en una escena.
- Puede ser transformado (escalado, rotado, trasladado).
- Puede recibir eventos de interacción (como clics, teclas, etc.).
- Puede colisionar y detectar colisiones con otros objetos.
***
## Métodos principales de QGraphicsItem
1. ### QGraphicsItem(QGraphicsItem *parent = nullptr)
    Constructor de un objeto gráfico.

     Parámetros:
    - parent: El elemento padre de este objeto, si está anidado dentro de otro objeto gráfico.

    Ejemplo:
    ```cpp
    class CustomItem : public QGraphicsItem {
    public:
        CustomItem(QGraphicsItem *parent = nullptr) : QGraphicsItem(parent) {}
    };
    ```
2. ### virtual QRectF boundingRect() const
    Devuelve el rectángulo delimitador del objeto, utilizado por la escena para determinar el área que ocupa.

    Ejemplo:
    ```cpp
    QRectF boundingRect() const override {
        return QRectF(0, 0, 100, 100);
    }
    ```
3. ### virtual void paint(QPainter *painter, const QStyleOptionGraphicsItem *option, QWidget *widget)
    Sobrescribe este método para definir cómo se dibuja el objeto en la pantalla.

    Ejemplo:
    ```cpp
    void paint(QPainter *painter, const QStyleOptionGraphicsItem *option, QWidget *widget) override {
        painter->setBrush(Qt::blue);
        painter->drawRect(boundingRect());
    }
    ```
4. ### virtual bool contains(const QPointF &point) const
    Devuelve true si el punto especificado está dentro de los límites del objeto.
    
    Ejemplo:
    ```cpp
    bool contains(const QPointF &point) const override {
        return boundingRect().contains(point);
    }
    ```
5. ### void setPos(qreal x, qreal y)
    Establece la posición del objeto en la escena.

    Parámetros:
    - x: La coordenada X.
    - y: La coordenada Y.
    
    Ejemplo:
    ```cpp
    item->setPos(50, 50);
    ```
6. ### QPointF pos() const
    Devuelve la posición actual del objeto.

    Ejemplo:
    ```cpp
    QPointF position = item->pos();
    ```
7. ### void setRotation(qreal angle)
    Establece la rotación del objeto en grados alrededor de su punto de origen.
    
    Parámetros:
    - angle: Ángulo de rotación en grados.

    Ejemplo:
    ```cpp
    item->setRotation(45);  // Rota 45 grados
    ```
8. ### qreal rotation() const
    Devuelve el ángulo de rotación actual del objeto.

    Ejemplo:
    ```cpp
    qreal currentRotation = item->rotation();
    ```
9. ### void setScale(qreal scaleFactor)
    Escala el objeto por un factor dado.

    Parámetros:
    - scaleFactor: Factor de escala (1.0 es sin cambio).

    Ejemplo:
    ```cpp
    item->setScale(2.0);  // Doble tamaño
    ```
10. ### void setVisible(bool visible)
    Cambia la visibilidad del objeto.

    Parámetros:
    - visible: true para mostrar el objeto, false para ocultarlo.

    Ejemplo:
    ```cpp
    item->setVisible(false);  // Ocultar el objeto
    ```
11. ### QGraphicsItem *parentItem() const
    Devuelve el objeto gráfico padre, si este elemento está anidado dentro de otro.
    
    Ejemplo:
    ```cpp
    QGraphicsItem *parent = item->parentItem();
    ```
12. ### void setParentItem(QGraphicsItem *parent)
    Establece un objeto gráfico como padre de este objeto.
    
    Parámetros:
    - parent: El nuevo objeto padre.
    
    Ejemplo:
    ```cpp
    item->setParentItem(parentItem);
    ```
13. ### void update(const QRectF &rect = QRectF())
    Actualiza la región especificada del objeto, obligando a que se vuelva a pintar.
    
    Ejemplo:
    ```cpp
    item->update();  // Forzar actualización de todo el objeto
    ```
14. ### bool isVisible() const
    Devuelve true si el objeto está visible.
    
    Ejemplo:
    ```cpp
    bool visible = item->isVisible();
    ```
15. ### QGraphicsScene *scene() const
    Devuelve la escena a la que pertenece el objeto.
    
    Ejemplo:
    ```cpp
    QGraphicsScene *scene = item->scene();
    ```
16. ### bool collidesWithItem(const QGraphicsItem *other, Qt::ItemSelectionMode mode = Qt::IntersectsItemShape) const
    Verifica si este objeto colisiona con otro.
    
    Ejemplo:
    ```cpp
    if (item->collidesWithItem(otherItem)) {
        // Colisión detectada
    }
    ```
17. ### QGraphicsItem *childItem(int index) const
    Devuelve el elemento hijo en la posición especificada.
    
    Ejemplo:
    ```cpp
    QGraphicsItem *child = item->childItem(0);
    ```
18. ### QList<QGraphicsItem *> children() const
    Devuelve la lista de elementos gráficos hijos.
    
    Ejemplo:
    ```cpp
    QList<QGraphicsItem *> childrenList = item->children();
    ```
***
## Ejemplo Completo
```cpp
#include <QApplication>
#include <QGraphicsView>
#include <QGraphicsScene>
#include <QGraphicsItem>
#include <QPainter>

class CustomItem : public QGraphicsItem {
public:
    CustomItem(QGraphicsItem *parent = nullptr) : QGraphicsItem(parent) {}

    QRectF boundingRect() const override {
        return QRectF(0, 0, 100, 100);
    }

    void paint(QPainter *painter, const QStyleOptionGraphicsItem *option, QWidget *widget) override {
        painter->setBrush(Qt::blue);
        painter->drawRect(boundingRect());
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QGraphicsScene scene;
    CustomItem *item = new CustomItem();
    scene.addItem(item);
    item->setPos(50, 50);

    QGraphicsView view(&scene);
    view.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Crear un Objeto Personalizado
- Crea una clase que herede de QGraphicsItem y dibuje una estrella. Implementa los métodos boundingRect() y paint(). Añade varios objetos estrella a la escena y usa transformaciones (rotación, escala).
2.	### Detección de Colisiones
- Implementa una aplicación que añada varios objetos gráficos. Cada objeto puede moverse usando las teclas de flecha, y si dos objetos colisionan, deben cambiar de color.
3.	### Anidación de Objetos
- Crea una jerarquía de objetos gráficos donde algunos objetos sean hijos de otros. Implementa interacciones en las que mover el objeto padre también mueva a sus hijos.
4.	### Detección de Selección
- Implementa una funcionalidad donde el usuario pueda seleccionar un objeto gráfico haciendo clic sobre él. Cambia su color cuando es seleccionado.
***
Con estos ejercicios, estarás practicando la creación y manipulación de objetos gráficos personalizados, así como las interacciones y transformaciones en una escena gráfica.

