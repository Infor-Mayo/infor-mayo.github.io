
# Clase QCoreApplication 

Esta clase es la base de toda aplicación en Qt y gestiona el ciclo de vida de la aplicación, incluyendo eventos, argumentos de la línea de comandos y el bucle de eventos.

La clase QCoreApplication se utiliza para manejar aplicaciones sin interfaz gráfica (generalmente en aplicaciones de consola o servicios) y proporciona la infraestructura básica necesaria para cualquier aplicación en Qt. Aunque en aplicaciones con GUI se usa QApplication (una subclase de QCoreApplication), muchos conceptos son compartidos.

***

## Funcionalidades principales de QCoreApplication

1. ### Constructor
    - QCoreApplication(int &argc, char **argv)
    o	Este constructor inicializa la aplicación, recibiendo los argumentos de la línea de comandos (argc y argv). Estos argumentos pueden ser utilizados para personalizar el comportamiento de la aplicación al arrancar.

    Ejemplo:

    ```cpp
    int main(int argc, char *argv[]) {
        QCoreApplication app(argc, argv);
        qDebug() << "Número de argumentos:" << argc;
        qDebug() << "Primer argumento:" << argv[0];
        return app.exec();
    }
    ```
    - En este caso, se crea una aplicación de consola y se imprime el número de argumentos y el primer argumento (normalmente, el nombre del ejecutable).

2. ### Método exec()
    - int exec(): Inicia el bucle de eventos de la aplicación. La aplicación permanece activa hasta que se llama a quit() o exit().

    Ejemplo:

    ```cpp
    int main(int argc, char *argv[]) {
        QCoreApplication app(argc, argv);
        qDebug() << "Iniciando bucle de eventos...";
        return app.exec();  // Mantiene la aplicación ejecutándose
    }
    ``` 

3. ### Método quit()
    - void quit(): Este método termina el bucle de eventos y cierra la aplicación. Se puede usar para finalizar la ejecución cuando sea necesario.

    Ejemplo:

    ```cpp
    QTimer::singleShot(5000, &QCoreApplication::quit);  
    // Cierra la app después de 5 segundos
    ```

4. ### Método exit()
    - void exit(int returnCode = 0): Similar a quit(), pero permite especificar un código de retorno. Un valor diferente a 0 suele indicar un error.

    Ejemplo:

    ```cpp
    QTimer::singleShot(3000, []() {
        qDebug() << "Saliendo con error.";
        QCoreApplication::exit(1);  // Código de retorno 1 indica error
    });
    ```

5. ### Método applicationName() y setApplicationName()
    - QString applicationName(): Devuelve el nombre de la aplicación.
    - void setApplicationName(const QString &name): Establece el nombre de la aplicación.

    Ejemplo:

    ```cpp
    QCoreApplication::setApplicationName("MiAplicacion");
    qDebug() << "Nombre de la aplicación:" << QCoreApplication::applicationName();
    ```

6. ### Método applicationVersion() y setApplicationVersion()
    - QString applicationVersion(): Devuelve la versión de la aplicación.
    - void setApplicationVersion(const QString &version): Establece la versión de la aplicación.

    Ejemplo:

    ```cpp
    QCoreApplication::setApplicationVersion("1.0.0");
    qDebug() << "Versión de la aplicación:" << QCoreApplication::applicationVersion();
    ```

7. ### Método organizationName() y setOrganizationName()
    - QString organizationName(): Devuelve el nombre de la organización.
    - void setOrganizationName(const QString &name): Establece el nombre de la organización.

    Ejemplo:

    ```cpp
    QCoreApplication::setOrganizationName("MiOrganizacion");
    qDebug() << "Nombre de la organización:" << QCoreApplication::organizationName();
    ```

8. ### Método organizationDomain() y setOrganizationDomain()
    - QString organizationDomain(): Devuelve el dominio de la organización.
    - void setOrganizationDomain(const QString &domain): Establece el dominio de la organización.

    Ejemplo:

    ```cpp
    QCoreApplication::setOrganizationDomain("miempresa.com");
    qDebug() << "Dominio de la organización:" << QCoreApplication::organizationDomain();
    ```

9. ### Método applicationDirPath()
    - QString applicationDirPath(): Devuelve la ruta del directorio donde está el ejecutable de la aplicación.

    Ejemplo:

    ```cpp
    qDebug() << "Directorio del ejecutable:" << QCoreApplication::applicationDirPath();
    ```

10. ### Método arguments()
    - QStringList arguments(): Devuelve una lista con los argumentos de la línea de comandos pasados al iniciar la aplicación.

    Ejemplo:

    ```cpp
    QStringList args = QCoreApplication::arguments();
    qDebug() << "Argumentos de la línea de comandos:" << args;
    ```

***

## Ejercicios de consolidación:

1.	### Gestión de argumentos:
    - Crea una aplicación que reciba dos números desde la línea de comandos y los sume. Imprime el resultado en la consola.

    Ejemplo:
    ``` bash
    ./miapp 5 10
    ```
    El programa debe mostrar: La suma es: 15.

2.	### Aplicación con temporizador:
    - Escribe una aplicación que se cierre automáticamente después de 10 segundos usando QTimer y QCoreApplication::quit(). Mientras tanto, imprime un mensaje cada segundo usando QTimer.

3. ### 	Información de la aplicación:
    - Crea una aplicación que establezca el nombre, la versión, la organización y el dominio de la organización. Luego imprime esta información en la consola.

4.	### Código de retorno:
    - Desarrolla una aplicación que ejecute una tarea simple (como contar hasta 5) y luego cierre la aplicación con un código de retorno diferente en función del resultado (0 si todo sale bien, 1 si ocurre algún error).

5.	### Aplicación multiargumentos:
    - Crea una aplicación que procese múltiples argumentos de la línea de comandos. Si el primer argumento es saludar, imprime "Hola, [nombre]" (donde [nombre] es el segundo argumento), y si el primer argumento es adios, imprime "Adiós, [nombre]" antes de salir con un código 0.

***

Con estas funcionalidades y ejercicios, podrás explorar en profundidad QCoreApplication y comprender cómo gestionar el ciclo de vida de una aplicación Qt sin interfaz gráfica. 

