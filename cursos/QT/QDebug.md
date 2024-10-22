# Clase QDebug

La clase QDebug, que es una clase muy útil en Qt para depuración. QDebug se utiliza principalmente para imprimir mensajes de diagnóstico y seguimiento en la consola o en otros medios, como archivos de registro. Es una herramienta fundamental cuando estás desarrollando aplicaciones y necesitas entender el comportamiento interno o encontrar errores en tu código.

La clase QDebug proporciona una interfaz para escribir información de depuración en una salida, típicamente la consola. Se utiliza comúnmente con la función qDebug(), pero también puedes usar variantes como qWarning(), qCritical(), y qFatal() para distintos niveles de severidad.

***

## Funcionalidades principales de QDebug
1. ### qDebug()
    - qDebug(): Imprime un mensaje de depuración en la consola. Este mensaje se muestra solo si las configuraciones de compilación están en modo "Debug" (depuración). En aplicaciones de producción, estos mensajes no aparecerán si la aplicación se compila en modo "Release".

    Ejemplo:
    ```cpp
    qDebug() << "Este es un mensaje de depuración.";
    ```

    Salida:
    ```
    Este es un mensaje de depuración.
    ```
2. ### qWarning()
    - qWarning(): Imprime un mensaje de advertencia. Esto se utiliza para señalar condiciones inesperadas pero no críticas.

    Ejemplo:
    ```cpp
    qWarning() << "Advertencia: algo inesperado ocurrió.";
    ```

    Salida:
    ```makefile
    Advertencia: algo inesperado ocurrió.
    ```
3. ### qCritical()
    - qCritical(): Se usa para mensajes de error críticos que pueden afectar seriamente el comportamiento de la aplicación.

    Ejemplo:
    ```cpp
    qCritical() << "Error crítico: algo falló.";
    ```

    Salida:
    ```javascript
    Error crítico: algo falló.
    ```
4. ### qFatal()
    - qFatal(): Imprime un mensaje de error grave y finaliza la aplicación inmediatamente después de mostrar el mensaje.

    Ejemplo:
    ```cpp
    qFatal("Error fatal: no se puede continuar.");
    ```

    Salida:
    ```yaml
    Error fatal: no se puede continuar.
    ```
5. ### QDebug con diferentes tipos de datos
    - QDebug es muy flexible y soporta muchos tipos de datos, incluyendo:
        - Tipos primitivos (int, float, bool, etc.)
        - Strings (QString, QByteArray)
        - Listas, arrays, y otros contenedores (QList, QMap, QVector)
        - Objetos personalizados (si implementas el operador <<)

    Ejemplo:
    ```cpp
    int numero = 42;
    QString texto = "Hola Qt";
    QList<int> lista = {1, 2, 3, 4, 5};

    qDebug() << "Número:" << numero;
    qDebug() << "Texto:" << texto;
    qDebug() << "Lista:" << lista;
    ```

    Salida:
    
    ```makefile
    Número: 42
    Texto: "Hola Qt"
    Lista: (1, 2, 3, 4, 5)
    ```

6. ### Configuración del formato de salida
    - Puedes cambiar el comportamiento de QDebug para ajustar cómo se muestra la información. Por ejemplo, puedes configurar el formato de salida para que no haya espacios entre los elementos.

    Ejemplo:
    ```cpp
    QDebug debugg(qDebug());
    debugg.noquote().nospace() << "Valor de X:" << 123;

    Salida:
    ```
    Valor de X:123
    ```

7. ### Redirigir la salida de depuración
    - Puedes redirigir la salida de QDebug para que se guarde en un archivo en lugar de mostrarse en la consola. Esto es útil cuando quieres mantener un registro de eventos mientras la aplicación está en ejecución.

    Ejemplo (redirigiendo a un archivo):
    ```cpp
    QFile archivo("registro.txt");
    archivo.open(QIODevice::WriteOnly | QIODevice::Text);
    QTextStream stream(&archivo);
    stream << "Este es un mensaje de depuración.\n";
    archivo.close();
    ```

8. ### Operador << personalizado
    - Puedes definir cómo se comporta QDebug para tus propios objetos si implementas el operador de inserción (<<).

    Ejemplo:
    ```cpp
    class MiClase {
    public:
        int valor;
        MiClase(int v) : valor(v) {}
    };

    QDebug operator<<(QDebug debugg, const MiClase &obj) {
        debugg.nospace() << "MiClase(valor=" << obj.valor << ")";
        return debugg;
    }

    MiClase obj(10);
    qDebug() << obj;
    ```

    Salida:
    ```scss
    MiClase(valor=10)
    ```

***

## Ejemplos prácticos
1. ### Depuración básica
    Este ejemplo muestra cómo usar qDebug(), qWarning(), y qCritical() para mostrar diferentes niveles de mensajes de depuración.

    ```cpp
    #include <QCoreApplication>
    #include <QDebug>

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);

        qDebug() << "Mensaje de depuración.";
        qWarning() << "Este es un mensaje de advertencia.";
        qCritical() << "Este es un mensaje de error crítico.";

        return a.exec();
    }
    ```
2. ### Redirigiendo la salida de QDebug a un archivo
    En este ejemplo, toda la salida de qDebug() se guarda en un archivo en lugar de aparecer en la consola.

    ```cpp
    #include <QCoreApplication>
    #include <QFile>
    #include <QTextStream>
    #include <QDebug>

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);

        QFile archivo("registro.txt");
        if (archivo.open(QIODevice::WriteOnly | QIODevice::Text)) {
            QTextStream stream(&archivo);
            stream << "Mensaje guardado en archivo.\n";
            archivo.close();
        }

        return a.exec();
    }
    ```
3. ### Uso de QDebug con contenedores
    Este ejemplo muestra cómo QDebug maneja tipos de contenedores de Qt como listas y mapas.

    ```cpp
    #include <QCoreApplication>
    #include <QDebug>
    #include <QList>
    #include <QMap>

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);

        QList<int> lista = {1, 2, 3, 4, 5};
        QMap<QString, int> mapa;
        mapa["uno"] = 1;
        mapa["dos"] = 2;

        qDebug() << "Lista:" << lista;
        qDebug() << "Mapa:" << mapa;

        return a.exec();
    }
    ```
4. ### Operador << personalizado para una clase
    Este ejemplo muestra cómo personalizar la salida de QDebug para una clase personalizada.

    ```cpp
    #include <QCoreApplication>
    #include <QDebug>

    class Punto {
    public:
        int x, y;
        Punto(int x, int y) : x(x), y(y) {}
    };

    QDebug operator<<(QDebug debugg, const Punto &p) {
        debugg.nospace() << "Punto(" << p.x << ", " << p.y << ")";
        return debugg;
    }

    int main(int argc, char *argv[]) {
        QCoreApplication a(argc, argv);

        Punto p(10, 20);
        qDebug() << p;

        return a.exec();
    }
    ```
***

## Ejercicios de Consolidación
1.	### Ejercicio básico de QDebug:
    - Escribe un programa que imprima tres tipos de mensajes diferentes: depuración, advertencia y error crítico.
2.	### Redirigir la salida de depuración:
    - Modifica el ejercicio anterior para que la salida de depuración y advertencia se guarde en un archivo llamado log.txt.
3.	### Depuración de contenedores:
    - Crea un programa que almacene números en una lista y luego los imprima usando qDebug(). Después, crea un mapa (QMap) con claves de tipo QString y valores de tipo int e imprímelo con qDebug().
4.	### Operador << personalizado:
    - Implementa una clase llamada Rectangulo que tenga dos atributos: ancho y alto. Escribe una sobrecarga del operador << para QDebug que imprima Rectangulo(ancho=x, alto=y) cuando se use qDebug().
5.	### Nivel avanzado:
    - Crea una aplicación que registre toda la información de depuración en un archivo y luego implemente una función para rotar archivos de registro (crear un nuevo archivo de registro cuando el tamaño del archivo actual supera un límite).

***

Con esta información y ejercicios, tendrás un sólido entendimiento de cómo utilizar QDebug para depurar tus aplicaciones en Qt y personalizar la salida según tus necesidades.

