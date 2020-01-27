SELECT C.ORDER_ID, C.ORDER_AMOUNT, C.ORDER_INVOICE, C.ORDER_DATE, C.ORDER_STATUS, C.CUSTOMER_ID, P.PRODUCT_TITLE, C.QTY
FROM CUSTOMER_ORDER C, PRODUCT P, TRADER T 
WHERE C.PRODUCT_ID = P.PRODUCT_ID
AND P.TRADER_ID = T.TRADER_ID
AND C.ORDER_DATE BETWEEN (SYSDATE-7) AND  SYSDATE
AND T.TRADER_EMAIL = :SESSION_EMAIL;
