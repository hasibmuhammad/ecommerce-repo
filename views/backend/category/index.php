<?php

use App\Models\Category;

partialView('_dash_header');?>
  <body>
    <?php partialView('_dash_sidebar');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Category</h1>
            </div>
            <?php partialView('_notification');?>
            <form action="/dashboard/categories" method="post" class="form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status"></label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-success btn-block" name="categorySubmit" value="Add Category">
                </div>
            </form>


            <div class="container">
            <h2 class="text-center">Category List</h2>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $categories = Category::all();
                foreach ($categories as $category):
                ?>
                    <tr>
                        <td><?php echo $category->id; ?></td>
                        <td><?php echo $category->title; ?></td>
                        <td><?php echo $category->slug; ?></td>
                    </tr>
                <?php endforeach;?>

                </tbody>
                </table>
            </div>


        </main>
    </div>
</div>
<?php partialView('_dash_footer');?>
