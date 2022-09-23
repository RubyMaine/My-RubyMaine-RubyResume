<?php 
    include("template/front/header.php");
    include("template/front/navbar.php");
    include("config/database.php");
?>
<?php
    $i=1;
    $statement = $conn->prepare('SELECT * FROM contact ORDER BY contact_id DESC');
    $statement->execute();
    $contact = $statement->fetchAll(PDO::FETCH_ASSOC);
    $sNo  = 1;
    foreach ($contact as $contact);
?>
<section class="contact">
    <h1 class="heading"> СВЯЗАТЬСЯ <span> СО МНОЙ </span> </h1>
    <div class="row">
        <div class="info-container">
            <h1> Информации об проекты </h1>
            <p><?php echo $contact['contact_info']; ?></p>
            <div class="share">
                <a target="_blank" href="https://website.com/<?php echo $contact['contact_fb']; ?>" class="fa fa-globe"></a>
                <a target="_blank" href="https://github.com/<?php echo $contact['contact_wts']; ?>" class="fa fa-github"></a>
                <a target="_blank" href="https://t.me/<?php echo $contact['contact_insta']; ?>" class="fa fa-telegram"></a>
                <!-- <a target="_blank" href="https://twitter.com/<?php echo $contact['contact_tw']; ?>" class="fa fa-telegram"></a>  -->
            </div>
        </div>
        <div class="row">
            <div class="info-container">
                <div class="box-container">
                    <h1> КОНТАКТЫ </h1>
                    <div class="box">
                        <i class="fas fa-map"></i>
                        <div class="info">
                            <h3> АДРЕС :</h3>
                            <p><?php echo $contact['contact_address']; ?></p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fas fa-envelope"></i>
                        <div class="info">
                            <h3> E-Mail :</h3>
                            <p><?php echo $contact['contact_email']; ?></p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fas fa-phone"></i>
                        <div class="info">
                            <h3> КОНТАКТ :</h3>
                            <p><?php echo $contact['contact_phone']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

                <div class="box-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d518.531279060117!2d69.30686945545357!3d41.30619677461875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sru!2s!4v1663836279118!5m2!1sru!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

        </div>
</section>

<?php include("template/front/footer.php"); ?>