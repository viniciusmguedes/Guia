<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form id="form">
    <input type="text" name="name" value="Vini">
    <input type="text" name="description" value="Melhor Wiski da região">
    <input type="file" name="photo" id="file">
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    $('#file').on('change', function () {
        let formData = new FormData();
        formData.append('name', 'Vini');
        formData.append('description', 'Melhor Wiski da região');
        formData.append('photo', $('#file')[0].files[0]);
        let headers = {
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY5ODczMzZlZDk3OWM5ZDQ0ZjBhZTYwMzg2MzRiMGM0MDUwMGVjMTlhMTVmZjI3YWQ2NGFmOTQ0NmVlYjRmZjhhODUzMWIwMmQ0MzA1OThiIn0.eyJhdWQiOiIyIiwianRpIjoiNjk4NzMzNmVkOTc5YzlkNDRmMGFlNjAzODYzNGIwYzQwNTAwZWMxOWExNWZmMjdhZDY0YWY5NDQ2ZWViNGZmOGE4NTMxYjAyZDQzMDU5OGIiLCJpYXQiOjE1MTM0OTE3MTQsIm5iZiI6MTUxMzQ5MTcxNCwiZXhwIjoxNTQ1MDI3NzE0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.c2jtyz3_GZmeEmDDE2f9nj29JYQ0WXz47hyYvKdN2pfiZZi-7fkH8qJFjQaMST0p_R8RuDZQUPl7fjdCyBKOAyF3nU2qVA29VOh29i_ckDp0luAJDdFcIY8IA1oOtcT_c2JnmRfFeh1TsLYpUouy-PL8LhRjtw4ChOYHUpzp38-2Ka91EJVysn2X9HMfgGfnJVNS6aNdSSmQ2AmU0l27PNDSEkBPT3Jy3t6G74LevK1uF_8gI_BOpOMCgylzOfzBN_cI-AEd0WnL0qiWCOb9gLubWSBHiubH5pf3-PQ-Nj1LvV_MzmrJL9USxfWmFk0WYY0NZ1rnsXH8-um1ncPDdJ34uKfFXRlDki8qWLqbwI6ArykKq2WT67vQUNOptjAXqYmgbwpFTXTTE8ODjjw5Yb6LxV_V0SpCygL2uKNNwevIqv0kv9xnb2H9pjoKunPpXfb7ewQQ1jfN_9cM4k0Kg9wvNok_UTjRIVTS7BFOU6Wl_hgVD4IZjquoZLBOg2yKzOc1_uQPd8kTgJbIjVhEqFeS5YJQ38trwqduXr7O68YNSYJ-QVq4TI7kz_aNSCaZVgzeqry8pCSahOhwqwsvqR6YLxpui4UArF_qB0l6Xi5iR7gR27b0u6VOEdzyVxxmSzPg2PcRz_V_ZotuJX4KhfP2vKuZbflbnDqcUQlrHc8',
            //'content-type': 'multipart/form-data'
            'content-type': 'application/x-www-form-urlencoded'
        }
        axios.post('http://localhost:8000/api/v1/restaurants/1', formData, {headers: headers})
    })
</script>
</body>
</html>