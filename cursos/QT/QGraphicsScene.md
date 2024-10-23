---
layout: cabeza3
---

# Clase QGraphicsScene
QGraphicsScene es la clase en Qt que gestiona una escena que contiene elementos gráficos (QGraphicsItem). Actúa como un contenedor para los objetos gráficos en 2D y es responsable de organizar y coordinar su representación, así como de manejar eventos relacionados con la interacción del usuario.

Mientras que QGraphicsView se encarga de mostrar los gráficos en pantalla, QGraphicsScene gestiona los elementos gráficos y su disposición lógica.
***
## Características Principales
- Organiza y gestiona una colección de elementos gráficos (QGraphicsItem).
- Detecta colisiones entre los elementos.
- Gestiona el posicionamiento, renderizado y actualización de los objetos.
- Soporte para eventos de ratón, teclado y otros eventos de interacción.
***
## Métodos principales de QGraphicsScene
1. ### QGraphicsScene(QObject *parent = nullptr)
    Constructor que inicializa una escena vacía.

    Parámetros:
    - parent: El objeto padre opcional para gestionar el ciclo de vida.

    Ejemplo:
    ```cpp
    QGraphicsScene *scene = new QGraphicsScene();
    ```
2. ### void addItem(QGraphicsItem *item)
    Añade un objeto gráfico a la escena.

    Parámetros:
    - item: El objeto gráfico a añadir.

    Ejemplo:
    ```cpp
    QGraphicsRectItem *rect = new QGraphicsRectItem(0, 0, 100, 100);
    scene->addItem(rect);
    ```
3. ### QGraphicsRectItem* addRect(const QRectF &rect, const QPen &pen = QPen(), const QBrush &brush = QBrush())
    Añade un rectángulo a la escena y lo devuelve como un QGraphicsRectItem.

    Parámetros:
    - rect: Las coordenadas y tamaño del rectángulo.
    - pen: El borde del rectángulo.
    - brush: El relleno del rectángulo.

    Ejemplo:
    ```cpp
    QRectF rectangle(0, 0, 100, 50);
    scene->addRect(rectangle, QPen(Qt::black), QBrush(Qt::red));
    ```
4. ### QGraphicsEllipseItem* addEllipse(const QRectF &rect, const QPen &pen = QPen(), const QBrush &brush = QBrush())
    Añade una elipse a la escena y la devuelve como un QGraphicsEllipseItem.

    Parámetros:
    - rect: Las coordenadas y tamaño de la elipse.
    - pen: El borde de la elipse.
    - brush: El relleno de la elipse.

    Ejemplo:
    ```cpp
    QRectF ellipseRect(0, 0, 100, 50);
    scene->addEllipse(ellipseRect, QPen(Qt::green), QBrush(Qt::blue));
    ```
5. ### QGraphicsLineItem* addLine(const QLineF &line, const QPen &pen = QPen())
    Añade una línea a la escena.
    
    Parámetros:
    - line: La línea que se añadirá (coordenadas de inicio y fin).
    - pen: El borde de la línea.

    Ejemplo:
    ```cpp
    QLineF line(0, 0, 100, 100);
    scene->addLine(line, QPen(Qt::black));
    ```
6. ### QGraphicsTextItem* addText(const QString &text, const QFont &font = QFont())
    Añade un objeto de texto a la escena.
    
    Parámetros:
    - text: El texto a mostrar.
    - font: La fuente utilizada para el texto (opcional).
    
    Ejemplo:
    ```cpp
    scene->addText("¡Hola, Mundo!", QFont("Arial", 16));
    ```
7. ### QGraphicsPixmapItem* addPixmap(const QPixmap &pixmap)
    Añade una imagen (pixmap) a la escena.
    
    Parámetros:
    - pixmap: La imagen a añadir.
    
    Ejemplo:
    ```cpp
    QPixmap image("imagen.png");
    scene->addPixmap(image);
    ```
8. ### QGraphicsPolygonItem* addPolygon(const QPolygonF &polygon, const QPen &pen = QPen(), const QBrush &brush = QBrush())
    Añade un polígono a la escena.
   
    Parámetros:
    - polygon: El polígono a añadir.
    - pen: El borde del polígono.
    - brush: El relleno del polígono.
    
    Ejemplo:
    ```cpp
    QPolygonF polygon;
    polygon << QPointF(0, 0) << QPointF(100, 0) << QPointF(50, 100);
    scene->addPolygon(polygon, QPen(Qt::black), QBrush(Qt::yellow));
    ```
9. ### void removeItem(QGraphicsItem *item)
    Elimina un objeto gráfico de la escena.
    
    Parámetros:
    - item: El objeto gráfico a eliminar.
    
    Ejemplo:
    ```cpp
    scene->removeItem(rect);  // Eliminar el rectángulo previamente añadido
    ```
10. ### QList<QGraphicsItem *> items(const QRectF &rect, Qt::ItemSelectionMode mode = Qt::IntersectsItemShape) const
    Devuelve una lista de los objetos que intersectan con el área dada.
    
    Parámetros:
    - rect: El área rectangular.
    - mode: El modo de selección (por ejemplo, IntersectsItemShape o ContainsItemShape).
    
    Ejemplo:
    ```cpp
    QRectF selectionRect(0, 0, 50, 50);
    QList<QGraphicsItem *> selectedItems = scene->items(selectionRect);
    ```
11. ### QGraphicsItem *itemAt(const QPointF &position, const QTransform &deviceTransform) const
    Devuelve el objeto gráfico en la posición dada dentro de la escena.
    
    Parámetros:
    - position: La posición en la escena.
    - deviceTransform: La transformación del dispositivo.
    
    Ejemplo:
    ```cpp
    QGraphicsItem *item = scene->itemAt(QPointF(25, 25), QTransform());
    ```
***
## Ejemplo Completo
```cpp
#include <QApplication>
#include <QGraphicsView>
#include <QGraphicsScene>
#include <QGraphicsRectItem>

int main(int argc, char *argv[]) {
    QApplication a(argc, argv);

    // Crear la escena
    QGraphicsScene *scene = new QGraphicsScene();

    // Añadir objetos gráficos a la escena
    QGraphicsRectItem *rect = scene->addRect(0, 0, 100, 100, QPen(Qt::black), QBrush(Qt::red));
    scene->addEllipse(50, 50, 80, 40, QPen(Qt::green), QBrush(Qt::blue));
    scene->addText("¡Hola, Mundo!", QFont("Arial", 16));

    // Crear la vista y establecer la escena
    QGraphicsView *view = new QGraphicsView(scene);
    view->setRenderHint(QPainter::Antialiasing);
    view->show();

    return a.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Manipulación de Objetos Gráficos
- Crea una aplicación que muestre una escena con varios objetos gráficos (rectángulos, elipses, textos). Implementa funciones para eliminar objetos seleccionados.
2.	### Selección de Elementos
- Implementa una funcionalidad que permita seleccionar objetos gráficos en la escena utilizando un área de selección rectangular. Muestra información sobre los objetos seleccionados.
3.	### Movimiento y Transformación
- Crea una aplicación donde los objetos gráficos se puedan arrastrar y mover dentro de la escena. Añade botones para aplicar transformaciones como escalado y rotación.
4.	### Creación de Objetos desde la Interfaz
- Implementa una aplicación que permita al usuario crear nuevos objetos gráficos (rectángulos, elipses, textos) en la escena utilizando el ratón para definir sus posiciones.
***
Estos ejercicios te ayudarán a dominar el uso de QGraphicsScene en combinación con QGraphicsView para construir aplicaciones gráficas interactivas.



