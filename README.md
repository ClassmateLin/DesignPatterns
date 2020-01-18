# 设计模式

- 时隔半年再次回顾设计模式。

| 序号 |          模式名称和代码链接          |          模式类型          | 描述 |
| :--: | :----------------------------------: | :--: | :--: |
|  1   | [抽象工厂模式](./AbstractFactory.php) | 创建型 | **抽象工厂模式**在不指定具体类的情况下创建一系列相关或依赖对象。 通常创建的类都实现相同的接口。 抽象工厂的客户并不关心这些对象是如何创建的，它只是知道它们是如何一起运行的。 |
|  2   | [建造者模式](./Builder.php) | 创建型 | **建造者模式**是将一个复杂的对象的构建与它的表示分离，使得同样的构建过程可以创建不同的表示。创建者模式隐藏了复杂对象的创建过程， 它把复杂对象的创建过程加以抽象，通过子类继承或者重载的方式，动态的创建具有复合属性的对象。 |
|  3  | [工厂方法模式](./FactoryMethod.php) | 创建型 | 在**工厂方法模式**中，工厂父类负责定义创建产品对象的公共接口，而工厂子类则负责生成具体的产品对象，这样做的目的是将产品类的实例化操作延迟到工厂子类中完成 |
|  4   | [多例模式](Multi.php) | 创建型 | **多例模式**是指存在一个类有多个相同实例，而且该实例都是该类本身。 多例类可以有多个实例， 多例类必须自己创建、管理自己的实例，并向外界提供自己的实例。 多例模式实际上就是单例模式的推广。 |
|  5   | [对象池模式](Pooler.php) | 创建型 | **对象池模式**是一种提前准备了一组已经初始化了的对象『池』而不是按需创建或者销毁的创建型设计模式。 |
|  6   | [原型模式](./PrototypePattern.php) | 创建型 | **原型模式**是用于创建重复的对象，同时又能保证性能。 |
|  7   | [简单工厂模式](./SimpleFactory.php) | 创建型 | **简单工厂模式**是一个精简版的工厂模式。 它与静态工厂模式最大的区别是它不是『静态』的。 |
|  8   | [单例模式](./Singleton.php) | 创建型 | 在应用程序调用的时候，只能获得一个对象实例。 |
|  9   | [静态工厂模式](./StaticFactory.php) | 创建型 | 与抽象工厂模式类似，此模式用于创建一系列相关或相互依赖的对象。 **『静态工厂模式』**与**『抽象工厂模式』**的区别在于，只使用一个静态方法来创建所有类型对象， 此方法通常被命名为 `factory` 或 `build`。 |
|  10  | [适配器模式](./Adapter.php) | 结构型 | 将一个类的接口转换成可应用的兼容接口。适配器使原本由于接口不兼容而不能一起工作的那些类可以一起工作。如：客户端数据库适配器 |
|  11  | [桥接模式](./Bridge.php) | 结构型 | 将抽象部分与它的实现部分分离，使它们都可以独立地变化。 |
|  12  | [组合模式](./Composite.php) | 结构型 | 一组对象与该对象的单个实例的处理方式一致。 |
|  13  | [数据映射模式](./DataMapper.php) | 结构型 | 数据映射器是一种数据访问层，它执行持久性数据存储（通常是关系数据库）和内存数据表示（域层）之间的数据双向传输。_ |
|  14  | [装饰模式](./Decorator.php) | 结构型 | 为类实例动态增加新的功能。 |
|  15  | [依赖注入模式](./DependencyInjection.php) | 结构型 | 用松散耦合的方式来更好的实现可测试、可维护和可扩展的代码。 |
|  16  | [门面模式](./Facade.php) | 结构型 | **门面模式(外观模式)**，是指提供一个统一的接口去访问多个子系统的多个不同的接口，它为子系统中的一组接口提供一个统一的高层接口。使得子系统更容易使用。 |
|  17  | [流接口模式](./FluentInterface.php) | 结构型 | **流接口（Fluent Interface）**是指实现一种面向对象的、能提高代码可读性的 API 的方法，其目的就是可以编写具有自然语言一样可读性的代码，我们对这种代码编写方式还有一个通俗的称呼 —— 方法链。 |
|  18  | [享元模式](./Flyweight.php) | 结构型 | **享元模式（Flyweight Pattern**主要用于减少创建对象的数量，以减少内存占用和提高性能,它提供了减少对象数量从而改善应用所需的对象结构的方式。_ |
|  19  | [代理模式](./Proxy.php) | 结构型 | **代理模式（Proxy）**为其他对象提供一种代理以控制对这个对象的访问。使用代理模式创建代理对象，让代理对象控制目标对象的访问（目标对象可以是远程的对象、创建开销大的对象或需要安全控制的对象），并且可以在不改变目标对象的情况下添加一些额外的功能。 |
|  20  | [注册模式](./Registry.php) | 结构型 | **注册模式**是一种常见的设计模式，主要就是将多个实例注册到一个统一的注册器中，然后通过方法直接去调用需要的实例。 |
|  21  | [责任链模式](./ChainOfResponsibilities.php) | 行为型 | 使多个对象都有处理请求的机会，从而避免了请求的发送者和接收者之间的耦合关系。将这些对象串成一条链，并沿着这条链一直传递该请求，直到有对象处理它为止。 |
|  22  | [命令模式](./Command.php) | 行为型 | **命令模式**，封装了方法调用细节，以解耦请求者与执行者。 |
|  23  | [迭代器模式](./Iterator.php) | 行为型 | **迭代器模式（Iterator）**，提供一种方法顺序访问一个聚合对象中的各种元素，而又不暴露该对象的内部表示。 |
|  24  |                                      |                                      |      |
|  25  |                                      |                                      |      |


