<footer>
    <p>Footer</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php if ($js) : ?>
    <?php foreach ($js as $script): ?>
        <script src="js/<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>