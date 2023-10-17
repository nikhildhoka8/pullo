-- Create COUNTRY table
CREATE TABLE COUNTRY (
    countryId INT PRIMARY KEY AUTO_INCREMENT,
    country VARCHAR(255)
);

-- Create USER_TYPE table
CREATE TABLE USER_TYPE (
    userTypeId INT PRIMARY KEY AUTO_INCREMENT,
    userType VARCHAR(50)
);

-- Create PHONE_NUMBER table
CREATE TABLE PHONE_NUMBER (
    phoneNumberId INT PRIMARY KEY AUTO_INCREMENT,
    countryCode INT,
    phoneNumber INT
);

-- Create STATUS table
CREATE TABLE STATUS (
    statusId INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(100)
);

-- Create PAYMENT_METHOD table
CREATE TABLE PAYMENT_METHOD (
    paymentMethodId INT PRIMARY KEY AUTO_INCREMENT,
    paymentMethod VARCHAR(100)
);

-- Create PAYMENT_STATUS table
CREATE TABLE PAYMENT_STATUS (
    paymentStatusId INT PRIMARY KEY AUTO_INCREMENT,
    paymentStatus VARCHAR(100)
);

-- Create SIZE table
CREATE TABLE SIZE (
    sizeId INT PRIMARY KEY AUTO_INCREMENT,
    size INT
);

-- Create CATEGORY table
CREATE TABLE CATEGORY (
    categoryId INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(255)
);

-- Create BRAND table
CREATE TABLE BRAND (
    brandId INT PRIMARY KEY AUTO_INCREMENT,
    brandName VARCHAR(255)
);

-- Create PRODUCT table
CREATE TABLE PRODUCT (
    productId INT PRIMARY KEY AUTO_INCREMENT,
    categoryId INT,
    brandId INT,
    gender VARCHAR(40),
    productName VARCHAR(255),
    productDescription VARCHAR(255),
    productImageURL VARCHAR(255),
    price INT,
    FOREIGN KEY (categoryId) REFERENCES CATEGORY(categoryId),
    FOREIGN KEY (brandId) REFERENCES BRAND(brandId)
);

-- Create PAYMENT_DETAIL table
CREATE TABLE PAYMENT_DETAIL (
    paymentDetailId INT PRIMARY KEY AUTO_INCREMENT,
    paymentMethodId INT,
    paymentStatusId INT,
    paymentDate DATE,
    amount INT
);

-- Create DELIVERY_ADDRESS table
CREATE TABLE DELIVERY_ADDRESS (
    deliveryAddressId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    addressLine1 VARCHAR(255),
    addressLine2 VARCHAR(255),
    addressLine3 VARCHAR(255),
    city VARCHAR(255),
    pincode INT,
    state VARCHAR(255),
    countryId INT,
    FOREIGN KEY (userId) REFERENCES USER_TABLE(userId),
    FOREIGN KEY (countryId) REFERENCES COUNTRY(countryId)
);

-- Create USER_TABLE table
CREATE TABLE USER_TABLE (
    userId INT PRIMARY KEY AUTO_INCREMENT,
    userTypeId INT,
    fName VARCHAR(150),
    lName VARCHAR(150),
    phoneNumberId INT,
    email VARCHAR(255),
    password VARCHAR(255),
    dateOfBirth DATE,
    FOREIGN KEY (userTypeId) REFERENCES USER_TYPE(userTypeId),
    FOREIGN KEY (phoneNumberId) REFERENCES PHONE_NUMBER(phoneNumberId)
);

-- Create ORDER table
CREATE TABLE ORDER_TABLE (
    orderId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    deliveryAddressId INT,
    statusId INT,
    orderDate DATE,
    shipDate DATE,
    deliveryDate DATE,
    FOREIGN KEY (userId) REFERENCES USER_TABLE(userId),
    FOREIGN KEY (deliveryAddressId) REFERENCES DELIVERY_ADDRESS(deliveryAddressId),
    FOREIGN KEY (statusId) REFERENCES STATUS(statusId)
);

-- Create INVOICE table
CREATE TABLE INVOICE (
    invoiceId INT PRIMARY KEY AUTO_INCREMENT,
    orderId INT,
    invoiceDate DATE,
    paymentDetailId INT,
    FOREIGN KEY (orderId) REFERENCES ORDER(orderId),
    FOREIGN KEY (paymentDetailId) REFERENCES PAYMENT_DETAIL(paymentDetailId)
);

-- Create STOCK table
CREATE TABLE STOCK (
    stockId INT PRIMARY KEY AUTO_INCREMENT,
    productId INT,
    sizeId INT,
    quantity INT,
    FOREIGN KEY (productId) REFERENCES PRODUCT(productId),
    FOREIGN KEY (sizeId) REFERENCES SIZE(sizeId)
);

-- Create CART table
CREATE TABLE CART (
    cartId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    productId INT,
    sizeId INT,
    quantity INT,
    FOREIGN KEY (userId) REFERENCES USER_TABLE(userId),
    FOREIGN KEY (productId) REFERENCES PRODUCT(productId),
    FOREIGN KEY (sizeId) REFERENCES SIZE(sizeId)
);

-- Create ORDER_DETAIL table
CREATE TABLE ORDER_DETAIL (
    orderDetailId INT PRIMARY KEY AUTO_INCREMENT,
    orderId INT,
    productId INT,
    sizeId INT,
    quantity INT,
    FOREIGN KEY (orderId) REFERENCES ORDER(orderId),
    FOREIGN KEY (productId) REFERENCES PRODUCT(productId),
    FOREIGN KEY (sizeId) REFERENCES SIZE(sizeId)
);
