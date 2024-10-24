---
layout: cabeza3
---

# Clase QJSEngine
La clase QJSEngine en Qt proporciona un entorno para ejecutar código JavaScript dentro de una aplicación C++. Es una implementación del motor JavaScript que permite integrar scripts en las aplicaciones Qt. Esta clase facilita la evaluación de scripts, la interacción con objetos Qt y la manipulación de datos entre C++ y JavaScript.
***
## Características Principales de QJSEngine
- Ejecutar scripts JavaScript: Permite ejecutar fragmentos de código JavaScript en tiempo de ejecución.
- Interacción entre C++ y JavaScript: Puedes acceder a objetos C++ desde JavaScript y viceversa.
- Soporte para QVariant: Los valores de JavaScript pueden ser fácilmente convertidos a QVariant, lo que facilita la integración con las clases Qt.
***
## Métodos Principales
1. ### QJSEngine()
    Constructor predeterminado que crea un nuevo motor JavaScript.

    Ejemplo:
    ```cpp
    QJSEngine engine;
    ```
2. ### QJSValue evaluate(const QString &program, const QString &fileName = QString(), int lineNumber = 1)
    Ejecuta el script JavaScript contenido en program. También puedes proporcionar un nombre de archivo opcional y un número de línea inicial para la depuración.
    - Retorno: Devuelve un objeto QJSValue que representa el resultado de la evaluación.

    Ejemplo:
    ```cpp
    QJSValue result = engine.evaluate("var x = 10; x + 5;");
    qDebug() << "Resultado:" << result.toNumber();  // Salida: 15
    ```
3. ### QJSValue globalObject()
    Devuelve el objeto global de JavaScript. Puedes agregar propiedades o funciones a este objeto para hacerlas accesibles desde los scripts.

    Ejemplo:
    ```cpp
    QJSValue globalObj = engine.globalObject();
    globalObj.setProperty("miVariable", 42);
    engine.evaluate("miVariable += 8;");
    qDebug() << "miVariable:" << engine.evaluate("miVariable").toNumber();  // Salida: 50
    ```
4. ### QJSValue newObject()
    Crea un nuevo objeto JavaScript vacío y lo devuelve como un QJSValue.

    Ejemplo:
    ```cpp
    QJSValue obj = engine.newObject();
    obj.setProperty("nombre", "John");
    obj.setProperty("edad", 30);
    qDebug() << obj.property("nombre").toString();  // Salida: "John"
    ```
5. ### QJSValue newArray(uint length = 0)
    Crea un nuevo arreglo de JavaScript con un tamaño inicial opcional.

    Ejemplo:
    ```cpp
    QJSValue array = engine.newArray(3);
    array.setProperty(0, "Primero");
    array.setProperty(1, "Segundo");
    qDebug() << array.property(0).toString();  // Salida: "Primero"
    ```
6. ### QJSValue newFunction(QJSValue (*function)(QJSEngine *, const QJSValueList &))
    Crea una nueva función JavaScript que está vinculada a una función C++.

    Ejemplo:
    ```cpp
    QJSValue myFunction = engine.newFunction([](QJSEngine *engine, const QJSValueList &args) {
        if (args.size() > 0) {
            return engine->toScriptValue(args[0].toNumber() * 2);
        }
        return engine->toScriptValue(0);
    });
    engine.globalObject().setProperty("doble", myFunction);
    qDebug() << engine.evaluate("doble(10)").toNumber();  // Salida: 20
    ```
7. ### QJSValue newQObject(QObject *object)
    Crea un objeto JavaScript que representa un objeto QObject de C++. Esto permite acceder a las propiedades y métodos de un objeto Qt desde el script JavaScript.

    Ejemplo:
    ```cpp
    QLabel label;
    label.setText("Hola desde C++");
    QJSValue jsLabel = engine.newQObject(&label);
    engine.globalObject().setProperty("label", jsLabel);
    engine.evaluate("label.text = 'Modificado desde JavaScript';");
    qDebug() << label.text();  // Salida: "Modificado desde JavaScript"
    ```
8. ### toScriptValue() y fromScriptValue()
    Estos métodos permiten convertir valores entre C++ y JavaScript. toScriptValue convierte un valor C++ a un QJSValue y fromScriptValue hace la conversión inversa.

    Ejemplo:
    ```cpp
    int valorCpp = 42;
    QJSValue valorJS = engine.toScriptValue(valorCpp);
    int recuperado = engine.fromScriptValue<int>(valorJS);
    qDebug() << recuperado;  // Salida: 42
    ```
***
## Ejemplo Completo
Este ejemplo crea un entorno donde se define una variable, se ejecuta un script JavaScript y se recuperan valores modificados desde C++.
```cpp
#include <QCoreApplication>
#include <QJSEngine>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QJSEngine engine;

    // Definir una variable en el entorno JavaScript
    engine.globalObject().setProperty("miNumero", 100);

    // Ejecutar un script que modifica la variable
    engine.evaluate("miNumero += 50;");
    QJSValue resultado = engine.evaluate("miNumero");
    qDebug() << "Resultado después del script:" << resultado.toNumber();  // Salida: 150

    // Crear una función en C++ y llamarla desde JavaScript
    QJSValue funcionDoble = engine.newFunction([](QJSEngine *, const QJSValueList &args) {
        return args[0].toNumber() * 2;
    });
    engine.globalObject().setProperty("doblar", funcionDoble);

    QJSValue resultadoDoble = engine.evaluate("doblar(25);");
    qDebug() << "Resultado de la función doblar:" << resultadoDoble.toNumber();  // Salida: 50

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Ejecutar scripts básicos
- Escribe un programa que ejecute varios fragmentos de JavaScript utilizando QJSEngine. Prueba diferentes tipos de operaciones (aritméticas, manipulación de cadenas, etc.) y muestra los resultados en la consola.
2.	### Crear un objeto JavaScript
- Crea un objeto JavaScript utilizando newObject(), define varias propiedades, y accede a ellas desde C++.
3.	### Crear funciones C++ en JavaScript
- Define una función en C++ utilizando newFunction() y luego llama a esa función desde un script JavaScript. La función debe tomar uno o más parámetros y devolver un valor modificado.
4.	### Manipular objetos QObject
- Crea un QObject en C++ (como un botón o una etiqueta), expón sus propiedades y métodos a JavaScript usando newQObject(), y manipula el objeto desde un script.
5.	### Intercambio de datos entre C++ y JavaScript
- Usa toScriptValue() y fromScriptValue() para intercambiar datos complejos (como listas o mapas) entre C++ y JavaScript.

