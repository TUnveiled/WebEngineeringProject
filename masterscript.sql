
create table User(
    emailAddress varchar(255),
    passwordHash varchar(255),
    administrator bit,
    primary key (emailAddress)
);

create table Seller(
    userEmail varchar(255),
    sellerName varchar(255),
    primary key (sellerName),
    foreign key (userEmail) references User (emailAddress)
);

create table Product(
    productID integer,
    price double,
    stock integer,
    description varchar(511),
    manufacturer char,
    primary key (productID)
);

create table Listing(
    sellerName varchar(255),
    productID integer,
    primary key (sellerName, productID),
    foreign key (sellerName) references Seller (sellerName),
    foreign key (productID) references Product (productID)
);

create table customerOrder(
    orderID integer,
    buyerEmail varchar(255),
    sellerName varchar(255),
    productID integer,
    totalPrice double,
    sourceAddress varchar(255),
    custAddress varchar(255),
    primary key (orderID),
    foreign key (buyerEmail) references User (emailAddress),
    foreign key (sellerName, productID) references Listing (sellerName, productID)
);
