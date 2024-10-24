---
layout: cabeza3
---

# Clase QJSValue
QJSValue es una clase en Qt que representa un valor JavaScript en el motor de JavaScript de Qt (QJSEngine). Este valor puede representar cualquier tipo de valor JavaScript, como números, cadenas, objetos, funciones, booleanos o null/undefined. Es parte de la integración de JavaScript en aplicaciones C++ mediante el motor QJSEngine.
***
## Características Principales de QJSValue
- Soporte para Tipos JavaScript: Un QJSValue puede representar cualquier valor JavaScript, incluidos números, booleanos, cadenas, objetos, funciones, y los valores undefined o null.
- Mutabilidad: Un QJSValue que representa un objeto o una función puede ser modificado añadiendo o cambiando propiedades y métodos.
- Interoperabilidad con C++: Facilita el intercambio de datos entre JavaScript y C++.
***
## Métodos Principales
1. ### Constructores
    - QJSValue()

    Constructor por defecto que crea un valor JavaScript sin valor (undefined).

    Ejemplo:
    ```cpp
    QJSValue valor;  // Undefined
    ```
    - QJSValue(QJSEngine *engine, bool val)

    Crea un QJSValue que representa un valor booleano.

    Ejemplo:
    ```cpp
    QJSEngine engine;
    QJSValue valor = engine.newValue(true);
    ```
    - QJSValue(QJSEngine *engine, int val)

    Crea un QJSValue que representa un número entero.

    Ejemplo:
    ```cpp
    QJSEngine engine;
    QJSValue valor = engine.newValue(42);
    ```
    - QJSValue(QJSEngine *engine, const QString &val)

    Crea un QJSValue que representa una cadena de texto.

    Ejemplo:
    ```cpp
    QJSEngine engine;
    QJSValue valor = engine.newValue("Hola Qt");
    ```
2. ### Métodos de Información de Tipo
    - isBool()

    Retorna true si el valor es un booleano.

    Ejemplo:
    ```cpp
    QJSValue valor = engine.newValue(true);
    if (valor.isBool()) {
        qDebug() << "Es un booleano";
    }
    ```
    - isNumber()

    Retorna true si el valor es un número.

    Ejemplo:
    ```cpp
    QJSValue valor = engine.newValue(100);
    if (valor.isNumber()) {
        qDebug() << "Es un número";
    }
    ```
    - isString()
    
    Retorna true si el valor es una cadena de texto.

    Ejemplo:
    ```cpp
    QJSValue valor = engine.newValue("Texto");
    if (valor.isString()) {
        qDebug() << "Es una cadena";
    }
    ```
    - isObject()

    Retorna true si el valor es un objeto JavaScript.

    Ejemplo:
    ```cpp
    QJSValue obj = engine.newObject();
    if (obj.isObject()) {
        qDebug() << "Es un objeto";
    }
    ```
    - isFunction()

    Retorna true si el valor es una función JavaScript.

    Ejemplo:
    ```cpp
    QJSValue func = engine.evaluate("(function() { return 42; })");
    if (func.isFunction()) {
        qDebug() << "Es una función";
    }
    ```
    - isUndefined()

    Retorna true si el valor es undefined.

    Ejemplo:
    ```cpp
    QJSValue valor;
    if (valor.isUndefined()) {
        qDebug() << "Es undefined";
    }
    ```
3. ### Métodos de Conversión de Tipos
    - toBool()

    Convierte el valor a un booleano.

    Ejemplo:
    ```cpp
    QJSValue valor = engine.newValue(true);
    bool b = valor.toBool();
    ```
    - toNumber()

    Convierte el valor a un número.

    Ejemplo:
    ```cpp
    QJSValue valor = engine.newValue("42");
    double numero = valor.toNumber();  // Retorna 42.0
    ```
    - toString()

    Convierte el valor a una cadena de texto.

    Ejemplo:
    ```cpp
    QJSValue valor = engine.newValue(42);
    QString str = valor.toString();  // Retorna "42"
    ```
    - toObject()

    Convierte el valor en un objeto JavaScript. Si el valor no es un objeto, crea un nuevo objeto vacío.

    Ejemplo:
    ```cpp
    QJSValue valor = engine.newValue(42);
    QJSValue obj = valor.toObject();
    ```
4. ### Métodos para Manipular Propiedades
    - property(const QString &name)

    Obtiene una propiedad del objeto JavaScript con el nombre dado.

    Ejemplo:
    ```cpp
    QJSValue obj = engine.newObject();
    obj.setProperty("nombre", "Qt");
    QJSValue prop = obj.property("nombre");
    qDebug() << prop.toString();  // Salida: "Qt"
    ```
    - setProperty(const QString &name, const QJSValue &value)

    Establece una propiedad en el objeto JavaScript.

    Ejemplo:
    ```cpp
    QJSValue obj = engine.newObject();
    obj.setProperty("edad", engine.newValue(10));
    qDebug() << obj.property("edad").toNumber();  // Salida: 10
    ```
5. ### Invocar Funciones JavaScript
    - call(const QJSValueList &args = QJSValueList())

    Llama a una función JavaScript con los argumentos dados.

    Ejemplo:
    ```cpp
    QJSValue func = engine.evaluate("(function(x) { return x * 2; })");
    QJSValue resultado = func.call(QJSValueList() << 21);
    qDebug() << resultado.toNumber();  // Salida: 42
    ```
***
## Ejemplo Completo
El siguiente ejemplo demuestra cómo crear, manipular e interactuar con valores JavaScript usando QJSValue.
```cpp
#include <QCoreApplication>
#include <QJSEngine>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QJSEngine engine;

    // Crear valores simples
    QJSValue numero = engine.newValue(42);
    QJSValue cadena = engine.newValue("Hola Mundo");
    QJSValue booleano = engine.newValue(true);

    qDebug() << "Número:" << numero.toNumber();         // Salida: 42
    qDebug() << "Cadena:" << cadena.toString();         // Salida: "Hola Mundo"
    qDebug() << "Booleano:" << booleano.toBool();       // Salida: true

    // Crear un objeto
    QJSValue objeto = engine.newObject();
    objeto.setProperty("nombre", "Qt");
    objeto.setProperty("version", engine.newValue(6));
    qDebug() << "Nombre:" << objeto.property("nombre").toString();   // Salida: "Qt"
    qDebug() << "Versión:" << objeto.property("version").toNumber(); // Salida: 6

    // Crear una función y llamarla
    QJSValue funcion = engine.evaluate("(function(x) { return x * x; })");
    QJSValue resultado = funcion.call(QJSValueList() << 7);
    qDebug() << "Resultado de la función:" << resultado.toNumber();  // Salida: 49

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Crear valores de diferentes tipos
- Usa QJSValue para crear y manipular valores de diferentes tipos: números, cadenas, booleanos y objetos. Crea un objeto JavaScript y añade propiedades de varios tipos.
2.	### Propiedades de objetos
- Crea un objeto JavaScript que contenga varias propiedades. Manipula estas propiedades desde C++ usando property() y setProperty(). Luego, evalúa y accede a esas propiedades desde un script JavaScript.
3.	### Crear funciones en JavaScript
- Crea una función JavaScript que realice una operación matemática, como sumar dos números. Luego, invoca esa función desde C++ y manipula los resultados.

