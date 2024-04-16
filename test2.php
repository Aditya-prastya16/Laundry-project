<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="flex justify-center items-center h-fit my-10">
    <div class="bg-white rounded-lg overflow-hidden shadow-md">

    <!-- card1 -->
        <div class="bg-[#F6FAFF] shadow-inner p-6">
            <h2 class="text-2xl font-bold mb-4">Card 1</h2>
            <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>

    <!-- card2 -->
    <div class="ml-8 bg-white rounded-lg overflow-hidden shadow-lg">
        <div class="bg-[#F6FAFF] shadow-inner p-6">
            <h2 class="text-2xl font-bold mb-4">Card 2</h2>
            <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
</div>

</body>
</html>

<?php
echo $_SESSION['role'];
echo "<br>";
echo $_SESSION['username'];
echo "<br>";
echo $_SESSION['id_outlet'];
echo "<br>";
echo $_SESSION['id_user'];
?>