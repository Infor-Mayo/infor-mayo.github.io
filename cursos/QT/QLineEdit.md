---
layout: cabeza3
---

# Clase QLineEdit
QLineEdit es un widget que permite al usuario ingresar y editar texto en una sola línea. Ofrece diversas opciones para manejar la entrada, como validadores, máscaras de entrada y sugerencias automáticas, además de señales para detectar eventos como cambios en el texto o la confirmación del usuario.
***
## Funcionalidades clave de QLineEdit
1. ### Constructores
    - QLineEdit(QWidget *parent = nullptr): Crea una línea de texto vacía.
    - QLineEdit(const QString &text, QWidget *parent = nullptr): Crea una línea de texto con un texto inicial.

    Ejemplo:
    ```cpp
    QLineEdit *lineEdit = new QLineEdit("Texto inicial", this);
    ```
2. ### Establecer y obtener texto
    - setText(const QString &text): Establece el texto que aparece en el widget.
    - text(): Devuelve el texto actual que contiene el QLineEdit.

    Ejemplo:
    ```cpp
    QLineEdit *lineEdit = new QLineEdit(this);
    lineEdit->setText("Hola, Qt!");
    QString texto = lineEdit->text();  // Obtiene el texto actual
    ```
3. ### Ocultar texto (contraseñas)
    Puedes ocultar el texto del QLineEdit, lo cual es útil para campos de contraseña.
    - setEchoMode(QLineEdit::EchoMode mode): Cambia el modo de eco del texto. 

    Algunos modos comunes son:
    - QLineEdit::Normal: El texto es visible (modo por defecto).
    - QLineEdit::Password: El texto es reemplazado por asteriscos (***).

    Ejemplo:
    ```cpp
    QLineEdit *passwordEdit = new QLineEdit(this);
    passwordEdit->setEchoMode(QLineEdit::Password);  // Modo de contraseña
    ```
4. ### Validadores
    Los validadores restringen el tipo de texto que el usuario puede ingresar.
    - setValidator(const QValidator *validator): Establece un validador para el QLineEdit. Ejemplos de validadores son QIntValidator (para números enteros) o QDoubleValidator (para números decimales).

    Ejemplo:
    ```cpp
    QLineEdit *numberEdit = new QLineEdit(this);
    numberEdit->setValidator(new QIntValidator(0, 100, this));  // Solo permite números entre 0 y 100
    ```
5. ### Máscaras de entrada
    Las máscaras de entrada controlan el formato de los datos que el usuario puede ingresar (por ejemplo, una fecha o un número de teléfono).
    - setInputMask(const QString &inputMask): Establece una máscara de entrada.
    
    Algunos ejemplos son:
    - 000.000.000.000;_ para una dirección IP.
    - 00/00/0000 para una fecha.

    Ejemplo:
    ```cpp
    QLineEdit *ipEdit = new QLineEdit(this);
    ipEdit->setInputMask("000.000.000.000;_");  // Máscara de dirección IP
    ```
6. ### Texto de sugerencia (placeholder text)
    Puedes mostrar un texto de sugerencia cuando el QLineEdit está vacío.
    - setPlaceholderText(const QString &text): Establece el texto de sugerencia.
    - placeholderText(): Devuelve el texto de sugerencia actual.

    Ejemplo:
    ```cpp
    QLineEdit *lineEdit = new QLineEdit(this);
    lineEdit->setPlaceholderText("Introduce tu nombre...");
    ```
7. ### Selección de texto y manipulación del cursor
    QLineEdit ofrece varios métodos para manipular el cursor de texto y la selección dentro del texto.
    - selectAll(): Selecciona todo el texto.
    - setCursorPosition(int position): Establece la posición del cursor.
    - cursorPosition(): Devuelve la posición actual del cursor.

    Ejemplo:
    ```cpp
    QLineEdit *lineEdit = new QLineEdit("Texto de prueba", this);
    lineEdit->setCursorPosition(5);  // Mueve el cursor a la posición 5
    ```
8. ### Auto-completar
    Puedes habilitar el autocompletado usando QCompleter, lo que permite sugerir al usuario opciones basadas en el texto ingresado.
    - setCompleter(QCompleter *completer): Establece un QCompleter que sugiere opciones mientras el usuario escribe.

    Ejemplo:
    ```cpp
    QStringList palabras = {"Qt", "QLineEdit", "QWidget", "QMainWindow"};
    QCompleter *completer = new QCompleter(palabras, this);

    QLineEdit *lineEdit = new QLineEdit(this);
    lineEdit->setCompleter(completer);
    ```
9. ### Señales importantes
    - textChanged(const QString &text): Emitida cuando el texto cambia.
    - editingFinished(): Emitida cuando el usuario termina de editar (por ejemplo, al presionar Enter).
    - returnPressed(): Emitida cuando se presiona Enter.

    Ejemplo:
    ```cpp
    QLineEdit *lineEdit = new QLineEdit(this);
    connect(lineEdit, &QLineEdit::returnPressed, this, []() {
        qDebug() << "Se presionó Enter";
    });
    ```
***
## Ejemplos prácticos
1. ### Crear un campo de texto básico con texto sugerido
```cpp
#include <QApplication>
#include <QLineEdit>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLineEdit lineEdit;
    lineEdit.setPlaceholderText("Introduce tu nombre...");
    lineEdit.resize(200, 40);
    lineEdit.show();

    return app.exec();
}
```
2. ### Campo de texto para una contraseña
```cpp
#include <QApplication>
#include <QLineEdit>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLineEdit passwordEdit;
    passwordEdit.setEchoMode(QLineEdit::Password);
    passwordEdit.setPlaceholderText("Introduce tu contraseña");
    passwordEdit.resize(200, 40);
    passwordEdit.show();

    return app.exec();
}
```
3. ### Validar números en un rango específico
```cpp
#include <QApplication>
#include <QLineEdit>
#include <QIntValidator>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QLineEdit numberEdit;
    numberEdit.setValidator(new QIntValidator(0, 100, &numberEdit));  // Solo permite números entre 0 y 100
    numberEdit.setPlaceholderText("Introduce un número entre 0 y 100");
    numberEdit.resize(200, 40);
    numberEdit.show();

    return app.exec();
}
```
4. ### Autocompletar con sugerencias
```cpp
#include <QApplication>
#include <QLineEdit>
#include <QCompleter>
#include <QStringList>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QStringList sugerencias = {"Qt", "QWidget", "QLineEdit", "QMainWindow"};
    QCompleter completer(sugerencias);

    QLineEdit lineEdit;
    lineEdit.setCompleter(&completer);
    lineEdit.setPlaceholderText("Escribe algo...");
    lineEdit.resize(200, 40);
    lineEdit.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Validador de números decimales:
- Crea un QLineEdit que solo permita al usuario introducir números decimales en el rango de 0.0 a 100.0 utilizando QDoubleValidator.
2.	### Campo de contraseña:
- Diseña una ventana donde el usuario pueda introducir su nombre y una contraseña. El campo de la contraseña debe ocultar el texto y tener una máscara de entrada para limitar su longitud a 8 caracteres.
3.	### Autocompletar personalizado:
- Crea un QLineEdit con un sistema de autocompletar basado en un conjunto de sugerencias personalizadas que cambia según lo que el usuario escribe.
4.	### Máscara de entrada:
- Diseña un formulario donde el usuario pueda ingresar una fecha en formato dd/mm/yyyy utilizando una máscara de entrada que verifique el formato correcto.
5.	### Campo de búsqueda con autocompletado:
- Crea un QLineEdit que actúe como un campo de búsqueda con autocompletado que sugiera posibles términos de búsqueda a medida que el usuario escribe.
***
Estas son las características clave de QLineEdit. 
