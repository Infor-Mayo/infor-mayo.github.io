# Clase QObject

Vamos a profundizar en la clase QObject, que es una de las clases más importantes en Qt, ya que es la clase base de la mayoría de los objetos dentro del framework.
La clase QObject es fundamental en Qt porque proporciona una infraestructura para:
- Señales y slots, que permiten la comunicación entre objetos.
- Jerarquía de objetos (propiedad y destrucción automática de objetos hijos).
- Información en tiempo de ejecución sobre los objetos.
- Manejo de eventos y gestión de bucles de eventos.

***

## Funcionalidades principales de QObject

1. ### Constructor y Destructor
    - QObject(QObject *parent = nullptr): Crea un nuevo objeto QObject, opcionalmente con un objeto padre. Si el objeto padre se destruye, también se destruirán todos sus hijos automáticamente.
    
    Ejemplo:
    
    ```cpp
    QObject *padre = new QObject;
    QObject *hijo = new QObject(padre);  // Se destruirá automáticamente cuando "padre" sea destruido
    ```

2. ### Método parent()
    - QObject* parent(): Devuelve el padre del objeto si tiene uno.
    
    Ejemplo:

    ```cpp
    QObject *objeto = new QObject;
    QObject *padre = new QObject(objeto);
    qDebug() << "El padre es:" << objeto->parent();
    ```

3. ### Método children()
    - QList<QObject *> children(): Devuelve una lista con los hijos directos del objeto.
    
    Ejemplo:

    ```cpp
    QObject *padre = new QObject;
    QObject *hijo1 = new QObject(padre);
    QObject *hijo2 = new QObject(padre);
    QList<QObject *> hijos = padre->children();
    qDebug() << "Número de hijos:" << hijos.size();
    ```

4. ### Método deleteLater()
    - void deleteLater(): Marca el objeto para su destrucción en el próximo bucle de eventos. Esto es útil cuando quieres eliminar un objeto pero estás dentro de una función que lo sigue usando.

    Ejemplo:

    ```cpp
    QObject *objeto = new QObject;
    objeto->deleteLater();  // Se eliminará cuando finalice el ciclo de eventos actual
    ```

5. ### Método setObjectName() y objectName()
    - void setObjectName(const QString &name): Establece el nombre del objeto.
    - QString objectName(): Devuelve el nombre del objeto.

    Ejemplo:

    ```cpp
    QObject *objeto = new QObject;
    objeto->setObjectName("MiObjeto");
    qDebug() << "Nombre del objeto:" << objeto->objectName();
    ```

6. ### Método findChild() y findChildren()
    - QObject* findChild(const QString &name): Busca un hijo con el nombre dado.
    - QList<QObject*> findChildren(const QString &name): Devuelve una lista de hijos que coinciden con el nombre.

    Ejemplo:

    ```cpp
    QObject *padre = new QObject;
    QObject *hijo = new QObject(padre);
    hijo->setObjectName("Hijo");

    QObject *encontrado = padre->findChild<QObject*>("Hijo");
    if (encontrado) {
        qDebug() << "Encontrado:" << encontrado->objectName();
    }
    ```

7. ### Método event()
    - bool event(QEvent *event): Este método maneja los eventos enviados a los objetos. Es posible sobrescribir este método en clases derivadas para manejar eventos personalizados.

    Ejemplo:

    ```cpp
    class MiObjeto : public QObject {
        Q_OBJECT
    public:
        bool event(QEvent *e) override {
            if (e->type() == QEvent::Timer) {
                qDebug() << "Evento de temporizador recibido";
                return true;
            }
            return QObject::event(e);
        }
    };
    ```

***

## Señales y Slots

Una de las características más poderosas de QObject es su sistema de señales y slots, que facilita la comunicación entre objetos de manera segura y flexible.

8. ### Definir Señales y Slots
    - Las señales son emitidas por los objetos para indicar que algo ha sucedido.
    - Los slots son funciones que responden a estas señales.
    Definir señales y slots:
    ```cpp
    class MiClase : public QObject {
        Q_OBJECT
    public:
        MiClase(QObject *parent = nullptr) : QObject(parent) {}

    signals:
        void miSenal();  // Definir una señal

    public slots:
        void miSlot() {  // Definir un slot
            qDebug() << "Slot ejecutado";
        }
    };
    ```

9. ### Conectar Señales y Slots
    - connect(sender, SIGNAL(), receiver, SLOT()): Conecta una señal con un slot. Cuando se emita la señal, se ejecutará el slot correspondiente.
    Ejemplo:
    ```cpp
    MiClase *emisor = new MiClase;
    MiClase *receptor = new MiClase;

    QObject::connect(emisor, &MiClase::miSenal, receptor, &MiClase::miSlot);
    emit emisor->miSenal();  // Emitir la señal
    ```

10. ### Desconectar Señales y Slots
    - disconnect(sender, SIGNAL(), receiver, SLOT()): Desconecta una señal de un slot.
    Ejemplo:
    ```cpp
    QObject::disconnect(emisor, &MiClase::miSenal, receptor, &MiClase::miSlot);
    ```

***

## Ejercicios de consolidación:

1.	### Jerarquía de Objetos:
    - Crea un programa que cree una jerarquía de objetos. Establece un objeto padre y varios hijos. Muestra el número de hijos del padre en la consola.
    Desafío adicional: Encuentra un hijo por su nombre usando findChild().
2.	### Comunicación con Señales y Slots:
    - Crea dos clases. La primera clase emite una señal, y la segunda clase tiene un slot que imprime un mensaje cuando la señal es emitida. Conecta la señal al slot y haz que el programa ejecute esa comunicación.
3.	### Conexión de Temporizadores:
    - Utiliza un QTimer para emitir una señal cada segundo y conecta esta señal a un slot que imprima un mensaje en la consola. Usa el sistema de señales y slots para lograr esto.
4.	### Manejo de Eventos:
    - Sobreescribe el método event() en una subclase de QObject para capturar eventos de temporizador (QTimerEvent). Inicia un temporizador en tu objeto y maneja el evento de temporizador dentro de event().
5.	### Destrucción Automática:
    - Crea un programa que cree un objeto padre y varios objetos hijos. Implementa una función para destruir el padre y verifica si los hijos se destruyen automáticamente.

***

Con QObject como base, puedes construir aplicaciones complejas en Qt. Este conocimiento te será muy útil para manejar la comunicación entre objetos, la gestión de memoria y el manejo de eventos.

