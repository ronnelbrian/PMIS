use SPMS

ALTER TABLE delivery
ADD current_stock numeric(18, 0)

ALTER TABLE request_item_line
ADD current_stock numeric(18, 0)