<footer>
    <p>Footer</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<?php if ($js) : ?>
    <?php foreach ($js as $script): ?>
        <script src="js/<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>