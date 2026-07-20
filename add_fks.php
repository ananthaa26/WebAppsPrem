<?php
$queries = [
    "ALTER TABLE products ADD CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES product_category(id) ON DELETE CASCADE",
    "ALTER TABLE product_variants ADD CONSTRAINT fk_variants_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE",
    "ALTER TABLE transactions ADD CONSTRAINT fk_trans_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL",
    "ALTER TABLE transactions ADD CONSTRAINT fk_trans_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT",
    "ALTER TABLE transactions ADD CONSTRAINT fk_trans_variant FOREIGN KEY (variant_id) REFERENCES product_variants(id) ON DELETE SET NULL",
];

foreach ($queries as $query) {
    try {
        DB::statement($query);
        echo "SUCCESS: $query\n";
    } catch (\Exception $e) {
        echo "FAILED: $query\n";
        echo $e->getMessage() . "\n";
    }
}
