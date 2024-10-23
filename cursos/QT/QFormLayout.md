---
layout: cabeza3
---


# Clase QFormLayout
QFormLayout organiza widgets en dos columnas: la primera para las etiquetas (QLabel) y la segunda para los controles de entrada (QLineEdit, QCheckBox, etc.). El diseño se adapta automáticamente al tamaño de la ventana, manteniendo las etiquetas alineadas de manera coherente con los controles.
***
## Funcionalidades clave de QFormLayout
1. ### Añadir filas al formulario
    Puedes agregar widgets al formulario usando el método addRow(), que permite insertar una etiqueta y un widget asociado (generalmente un control de entrada).

    Ejemplo:
    ```cpp
    QFormLayout *layout = new QFormLayout;
    QLabel *nameLabel = new QLabel("Nombre:");
    QLineEdit *nameEdit = new QLineEdit;

    layout->addRow(nameLabel, nameEdit);
    ```
    También puedes agregar un solo widget que ocupe ambas columnas de una fila.

    Ejemplo:
    ```cpp
    QPushButton *submitButton = new QPushButton("Enviar");
    layout->addRow(submitButton);  // El botón ocupa ambas columnas
    ```
2. ### Insertar espacio entre las filas
    Para controlar el espacio entre las filas, puedes utilizar addRow() con un espacio vacío o insertar un separador entre ellas.

    Ejemplo:
    ```cpp
    layout->addRow(new QLabel("Correo:"), new QLineEdit);
    layout->addRow(new QLabel("Teléfono:"), new QLineEdit);
    layout->addRow(new QFrame());  // Separador vacío
    layout->addRow(new QLabel("Dirección:"), new QLineEdit);
    ```
3. ### Ajustar la alineación de las etiquetas y los widgets
    Puedes controlar la alineación de las etiquetas y widgets dentro de las filas utilizando setLabelAlignment() para las etiquetas y setFormAlignment() para los widgets. Las banderas de alineación incluyen Qt::AlignLeft, Qt::AlignRight, Qt::AlignCenter, etc.

    Ejemplo:
    ```cpp
    layout->setLabelAlignment(Qt::AlignRight);  // Alinea las etiquetas a la derecha
    layout->setFormAlignment(Qt::AlignCenter);  // Alinea los widgets al centro
4. ### Definir el espaciamiento y márgenes
    QFormLayout permite ajustar el espaciado entre los widgets y los márgenes alrededor del formulario.
    - setSpacing(): Controla el espaciado entre las filas.
    - setContentsMargins(): Define los márgenes alrededor del formulario.

    Ejemplo:
    ```cpp
    layout->setSpacing(10);  // Espaciado de 10 píxeles entre las filas
    layout->setContentsMargins(15, 15, 15, 15);  // Márgenes de 15 píxeles en todos los lados
    ```
5. ### Disposición de columnas mediante RowWrapPolicy
    La clase QFormLayout tiene una política de ajuste (RowWrapPolicy) que puede ser ajustada con setRowWrapPolicy() para definir cómo se comportan las filas cuando hay una falta de espacio horizontal.
    Políticas posibles:
    - QFormLayout::DontWrapRows: Las filas no se ajustan.
    - QFormLayout::WrapLongRows: Si una fila es demasiado larga, se ajusta.
    - QFormLayout::WrapAllRows: Todas las filas se ajustan.

    Ejemplo:
    ```cpp
    layout->setRowWrapPolicy(QFormLayout::WrapLongRows);
    ```
***
## Ejemplos prácticos
1. ### Crear un formulario básico
```cpp
#include <QApplication>
#include <QWidget>
#include <QFormLayout>
#include <QLabel>
#include <QLineEdit>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QFormLayout *layout = new QFormLayout;

    QLabel *nameLabel = new QLabel("Nombre:");
    QLineEdit *nameEdit = new QLineEdit;
    
    QLabel *emailLabel = new QLabel("Correo:");
    QLineEdit *emailEdit = new QLineEdit;

    QPushButton *submitButton = new QPushButton("Enviar");

    layout->addRow(nameLabel, nameEdit);
    layout->addRow(emailLabel, emailEdit);
    layout->addRow(submitButton);  // El botón ocupa ambas columnas

    window.setLayout(layout);
    window.setWindowTitle("Formulario Básico");
    window.show();

    return app.exec();
}
```
2. ### Formulario con varios tipos de controles
```cpp
#include <QApplication>
#include <QWidget>
#include <QFormLayout>
#include <QLineEdit>
#include <QCheckBox>
#include <QComboBox>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QFormLayout *layout = new QFormLayout;

    QLineEdit *nameEdit = new QLineEdit;
    QCheckBox *subscribeCheckBox = new QCheckBox("Suscribirse al boletín");
    QComboBox *genderComboBox = new QComboBox;
    genderComboBox->addItem("Masculino");
    genderComboBox->addItem("Femenino");

    QPushButton *submitButton = new QPushButton("Enviar");

    layout->addRow("Nombre:", nameEdit);
    layout->addRow(subscribeCheckBox);  // Casilla de verificación ocupa ambas columnas
    layout->addRow("Género:", genderComboBox);
    layout->addRow(submitButton);

    window.setLayout(layout);
    window.setWindowTitle("Formulario con Diferentes Controles");
    window.show();

    return app.exec();
}
```
3. ### Formulario con alineación personalizada
```cpp
#include <QApplication>
#include <QWidget>
#include <QFormLayout>
#include <QLabel>
#include <QLineEdit>
#include <QPushButton>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QFormLayout *layout = new QFormLayout;

    QLabel *nameLabel = new QLabel("Nombre:");
    QLineEdit *nameEdit = new QLineEdit;

    QLabel *emailLabel = new QLabel("Correo:");
    QLineEdit *emailEdit = new QLineEdit;

    QPushButton *submitButton = new QPushButton("Enviar");

    layout->addRow(nameLabel, nameEdit);
    layout->addRow(emailLabel, emailEdit);
    layout->addRow(submitButton);

    // Alineación de las etiquetas a la derecha
    layout->setLabelAlignment(Qt::AlignRight);
    // Alineación de los controles al centro
    layout->setFormAlignment(Qt::AlignCenter);

    window.setLayout(layout);
    window.setWindowTitle("Formulario con Alineación");
    window.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	Formulario de registro:
- Crea un formulario de registro que incluya campos para nombre, correo electrónico, contraseña y una casilla para aceptar términos y condiciones. Usa QFormLayout para organizar los widgets.
2.	Formulario de encuesta:
- Implementa un formulario de encuesta con etiquetas para preguntas y diferentes controles como campos de texto, casillas de verificación y menús desplegables (QComboBox). Asegúrate de que el formulario esté bien alineado y con suficiente espacio entre las filas.
3.	Formulario con alineación personalizada:
- Diseña un formulario que tenga las etiquetas alineadas a la derecha y los campos de texto alineados al centro. Utiliza setLabelAlignment() y setFormAlignment() para ajustar las alineaciones.
4.	Formulario con estiramiento y espaciado:
- Crea un formulario con varios campos de entrada (QLineEdit) y botones al final, donde los campos de entrada ocupen más espacio y el botón esté alineado a la derecha. Ajusta el espaciado entre las filas y los márgenes alrededor del formulario.
5.	Formulario dinámico:
- Implementa un formulario que permita agregar dinámicamente nuevas filas al hacer clic en un botón. Cada fila debe contener una etiqueta y un campo de texto. Usa addRow() para insertar las nuevas filas.
***
QFormLayout es ideal para organizar formularios en aplicaciones Qt de manera clara y profesional. Su capacidad de alinear widgets y etiquetas automáticamente facilita la creación de interfaces limpias y consistentes. 