---
layout: cabeza3
---

# Clase QListView
QListView es una clase de Qt que hereda de QAbstractItemView y proporciona una vista para mostrar datos en forma de lista. Es una de las vistas más comunes en la arquitectura Model-View de Qt y permite representar los datos de una manera sencilla en forma de filas individuales. Se utiliza comúnmente en combinación con modelos como QStringListModel, QStandardItemModel, o cualquier otro que implemente la interfaz de QAbstractItemModel.
***
## Funcionalidades Principales de QListView
1. ### Inicialización de QListView
    QListView se puede usar de manera independiente o con un modelo que contiene los datos que se quieren mostrar. Al igual que otras vistas en la arquitectura Model-View, necesita conectarse a un modelo.

    Ejemplo básico de creación de un QListView:
    ```cpp
    QListView *listView = new QListView(this);
    ```
2. ### Conexión con un Modelo
    Para que QListView muestre datos, debe estar vinculado a un modelo. Esto se hace con el método setModel(). Un modelo comúnmente utilizado es QStringListModel, que maneja listas de cadenas.

    Ejemplo básico de uso con QStringListModel:
    ```cpp
    QStringList list;
    list << "Elemento 1" << "Elemento 2" << "Elemento 3";

    QStringListModel *model = new QStringListModel(list);
    QListView *listView = new QListView;
    listView->setModel(model);  // Asignar el modelo a la vista
    listView->show();
    ```
3. ### Modos de Visualización
    QListView soporta diferentes modos de visualización de elementos, que pueden adaptarse a distintos casos de uso:

    - Modo de lista (por defecto): Muestra los elementos como una lista vertical.
    ```cpp
    listView->setViewMode(QListView::ListMode);  // Modo lista (vertical)
    ```
    - Modo de iconos: Muestra los elementos como íconos en varias filas y columnas.

    ```cpp
    listView->setViewMode(QListView::IconMode);  // Modo iconos (en cuadrícula)
    ```
4. ### Selección de Elementos
    QListView permite seleccionar uno o más elementos, dependiendo del modo de selección configurado:

    - Selección de un solo elemento (predeterminado):
    ```cpp
    listView->setSelectionMode(QAbstractItemView::SingleSelection);
    ```
    - Selección múltiple: Permite seleccionar varios elementos a la vez.
    ```cpp
    listView->setSelectionMode(QAbstractItemView::MultiSelection);
    ```
5. ### Modificar el Espaciado y el Alineamiento
    Puedes personalizar la forma en que los elementos se presentan en la vista, como ajustar el espaciado entre ítems o alinear los textos.
    - Establecer el espaciado entre ítems:
    ```cpp
    listView->setSpacing(10);  // Espacio de 10 píxeles entre ítems
    ```
    - Alinear los ítems en la vista:
    ```cpp
    listView->setFlow(QListView::TopToBottom);  // Flujo de los elementos de arriba a abajo
    ```
6. ### Personalización de la Vista
    Puedes cambiar el comportamiento visual del QListView, como permitir la disposición en cuadrículas o cambiar las dimensiones de los elementos.
    - Habilitar la visualización en cuadrícula:
    ```cpp
    listView->setGridSize(QSize(100, 100));  // Tamaño de cuadrícula 100x100 píxeles
    ```
    - Establecer el tamaño de los ítems:
    ```cpp
    listView->setIconSize(QSize(64, 64));  // Tamaño de los íconos de 64x64 píxeles
    ```
7. ### Permitir Arrastrar y Soltar
    QListView soporta la funcionalidad de arrastrar y soltar ítems para reorganizarlos, moverlos entre vistas, o incluso hacia y desde otras aplicaciones.
    - Habilitar el arrastre y la recepción de ítems:
    ```cpp
    listView->setDragEnabled(true);
    listView->setAcceptDrops(true);
    listView->setDropIndicatorShown(true);  // Mostrar indicador cuando se suelta un ítem
    ```
8. ### Obtener el Elemento Seleccionado
    Para acceder a los elementos seleccionados, se puede utilizar el método selectionModel() de la vista.

    Ejemplo de cómo obtener el elemento seleccionado:
    ```cpp
    QModelIndex index = listView->currentIndex();  // Obtener el índice seleccionado
    QString selectedItem = index.data(Qt::DisplayRole).toString();  // Obtener el texto del elemento
    ```
9. ### Conexión de Señales y Slots
    QListView emite varias señales útiles que permiten manejar eventos como la selección de elementos.
    - Detectar cuando se selecciona un ítem:
    ```cpp
    connect(listView->selectionModel(), &QItemSelectionModel::selectionChanged, 
            this, []() {
                qDebug() << "Selección de ítem cambiada";
            });
    ```
***
## Ejemplo Completo
1. ### Crear una Lista de Ítems Simples
```cpp
#include <QApplication>
#include <QListView>
#include <QStringListModel>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    // Crear el modelo de lista
    QStringList list;
    list << "Elemento 1" << "Elemento 2" << "Elemento 3";
    QStringListModel *model = new QStringListModel(list);

    // Crear la vista de lista
    QListView *listView = new QListView;
    listView->setModel(model);  // Asignar el modelo a la vista
    listView->setSelectionMode(QAbstractItemView::SingleSelection);

    listView->show();

    return app.exec();
}
```
2. ### Crear una Lista con Iconos y Selección Múltiple
```cpp
#include <QApplication>
#include <QListView>
#include <QStandardItemModel>
#include <QStandardItem>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    // Crear el modelo de lista
    QStandardItemModel *model = new QStandardItemModel;

    // Crear ítems con íconos
    for (int i = 0; i < 5; ++i) {
        QStandardItem *item = new QStandardItem(QIcon("ruta/icono.png"), "Elemento " + QString::number(i + 1));
        model->appendRow(item);
    }

    // Crear la vista de lista
    QListView *listView = new QListView;
    listView->setModel(model);
    listView->setViewMode(QListView::IconMode);  // Cambiar a modo de iconos
    listView->setSelectionMode(QAbstractItemView::MultiSelection);  // Permitir selección múltiple

    listView->show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1. ###	Lista de nombres: 
- Crea una aplicación con un QListView que permita mostrar una lista de nombres y seleccionar uno o varios. Al seleccionar un nombre, debe mostrarse en una etiqueta (QLabel) debajo de la lista.
2. ###	Arrastrar y soltar: 
- Implementa una lista que permita reorganizar los elementos mediante arrastrar y soltar dentro del QListView.
3. ###	Lista de iconos: 
- Crea una lista de QListView que muestre ítems con iconos y permita seleccionar múltiples ítems al mismo tiempo. Cambia el diseño de los elementos a una cuadrícula.
4. ###	Búsqueda en la lista: 
- Implementa una funcionalidad que permita filtrar los elementos en la lista a medida que el usuario escribe en un QLineEdit. Los elementos no coincidentes deben ocultarse de la vista.
***
Estos ejercicios ayudarán a consolidar el uso de QListView y sus funcionalidades más comunes, tanto en modo de lista como en modo de iconos.

