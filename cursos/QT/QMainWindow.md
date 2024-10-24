---
layout: cabeza3
---

# Clase QMainWindow
QMainWindow es una clase que extiende QWidget y proporciona una estructura principal estándar para aplicaciones. Lo que la distingue es que permite agregar menús, barras de herramientas, barras de estado, y widgets centrales de manera sencilla.
***
## Estructura típica de QMainWindow
QMainWindow sigue un diseño específico que incluye:
1.	Widget central: El área principal de la ventana, donde normalmente colocas el contenido principal de tu aplicación.
2.	Barras de menú: Un menú tradicional en la parte superior de la ventana (como "Archivo", "Editar", etc.).
3.	Barras de herramientas: Barra de botones o controles que facilitan el acceso rápido a las funcionalidades.
4.	Barras de estado: Una barra en la parte inferior para mostrar información relevante, como mensajes de estado o la actividad actual.
***
Funcionalidades clave de QMainWindow
1. ### Constructores
    - QMainWindow(QWidget *parent = nullptr, Qt::WindowFlags flags = 0): Crea una ventana principal. Puedes pasarle un widget padre y las banderas de la ventana (como si es flotante, sin bordes, etc.).

    Ejemplo:
    ```cpp
    QMainWindow *window = new QMainWindow();
    window->setWindowTitle("Ventana Principal");
    window->resize(600, 400);
    window->show();
    ```
2. ### Widget central
    El widget central es el contenido principal que aparece en la ventana. Puedes agregar un QWidget o cualquier otro widget derivado (como QTextEdit, QLabel, etc.) como widget central usando setCentralWidget().

    Ejemplo:
    ```cpp
    QMainWindow *window = new QMainWindow();
    QWidget *centralWidget = new QWidget();  // Crear el widget central
    window->setCentralWidget(centralWidget);  // Establecer el widget como central
    window->resize(400, 300);
    window->show();
    ```
3. ### Barras de menú
    QMainWindow facilita la creación de menús utilizando menuBar() y QMenu.
    - menuBar(): Devuelve la barra de menú de la ventana.
    - QMenu: Representa un menú en la barra de menú.

    Ejemplo:
    ```cpp
    QMainWindow *window = new QMainWindow();
    QMenuBar *menuBar = window->menuBar();

    QMenu *fileMenu = menuBar->addMenu("Archivo");
    QAction *exitAction = fileMenu->addAction("Salir");

    QObject::connect(exitAction, &QAction::triggered, window, &QMainWindow::close);

    window->resize(400, 300);
    window->show();
    ```
4. ### Barras de herramientas
    Las barras de herramientas permiten agregar íconos y accesos rápidos para funciones de la aplicación.
    - addToolBar(const QString &title): Agrega una barra de herramientas con un título.
    - QToolBar: Representa una barra de herramientas.

    Ejemplo:
    ```cpp
    QMainWindow *window = new QMainWindow();
    QToolBar *toolBar = window->addToolBar("Herramientas");

    QAction *newAction = new QAction("Nuevo", window);
    toolBar->addAction(newAction);

    window->resize(400, 300);
    window->show();
    ```
5. ### Barra de estado
    La barra de estado se usa para mostrar información breve al usuario, como mensajes de estado o actualizaciones.
    - statusBar(): Devuelve la barra de estado de la ventana.
    - showMessage(const QString &message, int timeout = 0): Muestra un mensaje en la barra de estado por un tiempo específico.

    Ejemplo:
    ```cpp
    QMainWindow *window = new QMainWindow();
    window->statusBar()->showMessage("Listo para trabajar", 2000);  // Mensaje por 2 segundos

    window->resize(400, 300);
    window->show();
    ```
6. ### Dock Widgets (Widgets acoplables)
    QMainWindow permite agregar widgets acoplables, es decir, widgets que el usuario puede mover y acoplar a diferentes lados de la ventana.
    - addDockWidget(Qt::DockWidgetArea area, QDockWidget *dockWidget): Agrega un QDockWidget en una posición determinada (arriba, abajo, izquierda, derecha).
    - QDockWidget: Representa un widget acoplable.

    Ejemplo:
    ```cpp
    QMainWindow *window = new QMainWindow();
    QDockWidget *dock = new QDockWidget("Dock", window);
    dock->setAllowedAreas(Qt::LeftDockWidgetArea | Qt::RightDockWidgetArea);

    window->addDockWidget(Qt::LeftDockWidgetArea, dock);

    window->resize(600, 400);
    window->show();
    ```
7. ### Controlar la disposición de widgets
    QMainWindow ofrece flexibilidad para organizar los elementos de la interfaz gráfica mediante layouts y disposición de widgets.

    Ejemplo:
    ```cpp
    QMainWindow *window = new QMainWindow();

    QWidget *centralWidget = new QWidget();
    QVBoxLayout *layout = new QVBoxLayout(centralWidget);

    QPushButton *button1 = new QPushButton("Botón 1");
    QPushButton *button2 = new QPushButton("Botón 2");

    layout->addWidget(button1);
    layout->addWidget(button2);

    window->setCentralWidget(centralWidget);
    window->resize(400, 300);
    window->show();
    ```
***
## Ejemplos prácticos
1. ### Crear una ventana con menú, barra de herramientas y barra de estado
```cpp
#include <QApplication>
#include <QMainWindow>
#include <QMenuBar>
#include <QToolBar>
#include <QStatusBar>
#include <QAction>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QMainWindow window;
    window.setWindowTitle("Ventana Principal Completa");

    // Crear barra de menú
    QMenu *fileMenu = window.menuBar()->addMenu("Archivo");
    QAction *exitAction = fileMenu->addAction("Salir");
    QObject::connect(exitAction, &QAction::triggered, &window, &QMainWindow::close);

    // Crear barra de herramientas
    QToolBar *toolBar = window.addToolBar("Herramientas");
    toolBar->addAction(exitAction);  // Añadir acción a la barra de herramientas

    // Mostrar mensaje en la barra de estado
    window.statusBar()->showMessage("Listo para trabajar");

    window.resize(600, 400);
    window.show();

    return app.exec();
}
```
2. ### Agregar un widget acoplable (Dock Widget)
```cpp
#include <QApplication>
#include <QMainWindow>
#include <QDockWidget>
#include <QTextEdit>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QMainWindow window;
    window.setWindowTitle("Ventana con Dock Widget");

    // Widget central
    QTextEdit *textEdit = new QTextEdit();
    window.setCentralWidget(textEdit);

    // Crear un Dock Widget
    QDockWidget *dockWidget = new QDockWidget("Dock", &window);
    dockWidget->setAllowedAreas(Qt::LeftDockWidgetArea | Qt::RightDockWidgetArea);

    // Agregar un widget dentro del Dock Widget
    QTextEdit *dockTextEdit = new QTextEdit();
    dockWidget->setWidget(dockTextEdit);

    // Agregar el Dock Widget a la ventana
    window.addDockWidget(Qt::RightDockWidgetArea, dockWidget);

    window.resize(600, 400);
    window.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Crea una ventana principal completa:
- Diseña una ventana con un menú que incluya opciones como "Nuevo", "Abrir" y "Salir", una barra de herramientas con íconos para esas acciones, y una barra de estado que muestre mensajes contextuales.
2.	### Agregar widgets acoplables:
- Crea una ventana principal que tenga un área central con un editor de texto (QTextEdit), y agrega un QDockWidget en el lado izquierdo con otro editor de texto, de modo que el usuario pueda mover y acoplar el dock en diferentes posiciones.
3.	### Widgets personalizados en la ventana principal:
- Crea una ventana principal que use varios widgets personalizados, como botones, etiquetas y cuadros de texto, en el área central y en un dock. Asegúrate de manejar eventos como clics en los botones o cambios de texto en los cuadros de texto.
4.	### Simulación de barra de progreso:
- Implementa un QMainWindow con un botón que al presionarse inicie un proceso simulado de carga (puedes usar QTimer para esto) y muestre el progreso en la barra de estado.


