---
layout: cabeza3
---

# Clase QMenuBar
La clase QMenuBar es parte de los elementos de la interfaz gráfica en Qt, utilizada para crear una barra de menús, que es comúnmente colocada en la parte superior de las ventanas principales. Un QMenuBar contiene menús desplegables que a su vez contienen acciones, cada una de las cuales realiza una operación cuando es seleccionada por el usuario.
*** 
## Características principales
- Menús jerárquicos: Los menús pueden contener submenús y acciones.
- Atajos de teclado: Es posible asignar atajos de teclado a las acciones dentro de los menús.
- Posicionamiento automático: En la mayoría de los sistemas, se coloca automáticamente en la parte superior de una ventana principal (QMainWindow).
*** 
## Métodos principales de QMenuBar
1. ### QMenuBar(QWidget *parent = nullptr)
    Constructor que crea una barra de menús. El parent suele ser la ventana principal (QMainWindow).

    Ejemplo:
    ```cpp
    QMenuBar *menuBar = new QMenuBar(this);
    ```
2. ### QMenu* addMenu(const QString &title)
    Añade un menú con el título dado a la barra de menús y devuelve un puntero a ese menú.

    Parámetros:
    - title: El texto que se mostrará como el título del menú.

    Ejemplo:
    ```cpp
    QMenu *fileMenu = menuBar->addMenu("Archivo");
    ```
3. ### QMenu* addMenu(QMenu *menu)
    Añade un menú ya creado a la barra de menús.

    Parámetros:
    - menu: El menú a agregar.

    Ejemplo:
    ```cpp
    QMenu *editMenu = new QMenu("Editar", this);
    menuBar->addMenu(editMenu);
    ```
4. ### QAction* addAction(const QString &title, const QObject *receiver, const char *member)
    Añade una acción directamente a la barra de menús. Esta acción, cuando se activa, llama a la función especificada en receiver y member.

    Parámetros:
    - title: El texto de la acción.
    - receiver: El objeto que manejará la acción.
    - member: La función que se llamará cuando la acción sea seleccionada.

    Ejemplo:
    ```cpp
    menuBar->addAction("Salir", this, SLOT(close()));
    ```
5. ### void setNativeMenuBar(bool native)
    Habilita o deshabilita el uso de la barra de menús nativa del sistema (en sistemas operativos que lo soporten, como macOS).

    Parámetros:
    - native: true para usar la barra de menús nativa; false para usar una barra personalizada.

    Ejemplo:
    ```cpp
    menuBar->setNativeMenuBar(false);
    ```
6. ### QAction* addSeparator()
    Añade un separador en la barra de menús. Los separadores son líneas divisorias que ayudan a agrupar elementos de manera más clara.

    Ejemplo:
    ```cpp
    menuBar->addSeparator();
    ```
7. ### void clear()
    Elimina todos los menús y acciones de la barra de menús.

    Ejemplo:
    ```cpp
    menuBar->clear();
    ```
8. ### QAction* addAction(QAction *action)
    Añade una acción existente a la barra de menús.

    Parámetros:
    - action: El objeto QAction a añadir.

    Ejemplo:
    ```cpp
    QAction *newAction = new QAction("Nuevo", this);
    menuBar->addAction(newAction);
    ```
*** 
## Ejemplo completo
Aquí un ejemplo simple de cómo crear un QMenuBar con varios menús y acciones:
```cpp
#include <QApplication>
#include <QMainWindow>
#include <QMenuBar>
#include <QMenu>
#include <QMessageBox>

class MainWindow : public QMainWindow {
    Q_OBJECT
public:
    MainWindow() {
        // Crear la barra de menús
        QMenuBar *menuBar = new QMenuBar(this);
        setMenuBar(menuBar);
        
        // Crear un menú "Archivo"
        QMenu *fileMenu = menuBar->addMenu("Archivo");
        
        // Añadir una acción al menú "Archivo"
        QAction *newAction = new QAction("Nuevo", this);
        fileMenu->addAction(newAction);
        connect(newAction, &QAction::triggered, this, &MainWindow::newFile);

        // Añadir un separador
        fileMenu->addSeparator();
        
        // Añadir una acción de "Salir"
        QAction *exitAction = new QAction("Salir", this);
        fileMenu->addAction(exitAction);
        connect(exitAction, &QAction::triggered, this, &MainWindow::close);

        // Crear un menú "Ayuda"
        QMenu *helpMenu = menuBar->addMenu("Ayuda");
        QAction *aboutAction = new QAction("Acerca de", this);
        helpMenu->addAction(aboutAction);
        connect(aboutAction, &QAction::triggered, this, &MainWindow::about);
    }

private slots:
    void newFile() {
        QMessageBox::information(this, "Nuevo", "Creando un nuevo archivo...");
    }
    
    void about() {
        QMessageBox::information(this, "Acerca de", "Aplicación de ejemplo con menús.");
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    MainWindow mainWindow;
    mainWindow.show();

    return app.exec();
}

#include "main.moc"
```
*** 
## Ejercicios de consolidación
1.	### Menú "Archivo" con acciones de apertura y guardado
- Crea un menú "Archivo" con las acciones "Abrir" y "Guardar". Al seleccionar "Abrir", muestra un cuadro de diálogo para elegir un archivo y mostrar su nombre en un mensaje. Al seleccionar "Guardar", muestra un cuadro de diálogo para guardar un archivo.
2.	### Submenús
- Crea un menú "Opciones" con un submenú que permita cambiar la configuración de la aplicación (como el idioma). El submenú debe incluir opciones de "Español" y "Inglés". Al seleccionar una de estas opciones, muestra un mensaje que indique el idioma seleccionado.
3.	### Atajos de teclado
- Añade atajos de teclado a las acciones en la barra de menús. Por ejemplo, asigna Ctrl+N para la acción "Nuevo" y Ctrl+Q para la acción "Salir".

