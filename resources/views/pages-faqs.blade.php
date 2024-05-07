@extends('layouts.master')
@section('title')
    FAQи
@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="Моніторинг світла" title="FAQи" />
@endsection

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4">
                <h5 class="card-title mb-3">Загальні питання</h5>
                <p class="text-muted">Відповіді на загальні питання по роботі сайту і як користуватись інтерфейсом для моніторингу наявності світла.</p>
            </div>
            <!--end col-->
            <div class="col-xl-8">
                <div class="accordion accordion-border-box" id="genques-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="info-faq">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#genques-collapseOne" aria-expanded="true"
                                aria-controls="genques-collapseOne">
                                Як працює цей сайт?
                            </button>
                        </h2>
                        <div id="genques-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="info-faq" data-bs-parent="#genques-accordion">
                            <div class="accordion-body">
                                Після реєстрації Ви в  <a href="/profile">Особистому кабінеті</a> в розділі "Мої будинки" зможете додати свої інтернет адреси для відстеження.
                                Далі сайт буде моніторити їх кожні 3 хвилини і збирати статистику про їх статус. Якщо статус змінився Ви можете підписатись на оновлення через
                                Telegram бота чи сповіщення на вашу email адресу.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="info-ip">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#genques-collapseTwo" aria-expanded="false"
                                aria-controls="genques-collapseTwo">
                                Яка інтернет адреса потрібна?
                            </button>
                        </h2>
                        <div id="genques-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="info-ip" data-bs-parent="#genques-accordion">
                            <div class="accordion-body">
                                1) Щоб дізнатись вашу публічну <b>статичну(постійну)</b> IP адресу (зараз ми бачимо її такою: <b><?=$_SERVER['SERVER_ADDR']?></b> ) ви можете використовувати сторонні сервіси, наприклад, <a href="https://ipgeolocation.io/">ipgeolocation.io</a>
                                чи <a href="https://2ip.ua/ua/">2ip.ua</a>.<br>
                                2) Або вибрати спосіб відправляти запити власноруч на наш API <br>
                                3) Чи використати нашу <b>програму для моніторингу</b> яку ви зможете запустити на вашому девайсі
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="info-Cron">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#genques-collapseThree" aria-expanded="false"
                                aria-controls="genques-collapseThree">
                                Як відправляти самому запити для моніторингу в Linux через Cron?
                            </button>
                        </h2>
                        <div id="genques-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="info-Cron" data-bs-parent="#genques-accordion">
                            <div class="accordion-body">
                                Після вибору способу моніторингу ви можете використовувати наш API для запитів через Cron для систем Linux

                                       <pre class="language-markup">
<code class="language-markup">
crontab -e
                                    </code>
                                        </pre>

                                Відкриєте файл з налаштуваннями cron та введіть наступні значення:
                                <pre class="language-markup">
                                <code class="language-markup">


*/3 * * * * /usr/bin/wget -t 1 -O - 'ВАШЕ ПОСИЛАННЯ'
                                </code>
                                        </pre>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="info-PHP">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#genques-collapseFour6" aria-expanded="false"
                                    aria-controls="genques-collapseFour6">
                                Як відправляти самому запити для моніторингу PHP скриптом?
                            </button>
                        </h2>
                        <div id="genques-collapseFour6" class="accordion-collapse collapse"
                             aria-labelledby="info-PHP" data-bs-parent="#genques-accordion">
                            <div class="accordion-body">
                                <pre class="language-markup">
                                        <code class="language-markup">
function curlGetHttps($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if ($error) {
        return "Error: " . $error;
    } else {
        return $response;
    }
}
// Приклад визову функції
$url = "ВАШЕ ПОСИЛАННЯ"; // Замінити на своє посилання URL для потрібного будинку
$response = curlGetHttps($url);
if (is_string($response)) {
    echo "Response:\n" . $response;
} else {
    echo "Error: Could not get response.";
}

                                    </code>
                                 </pre>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="info-Python">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#genques-collapseFour" aria-expanded="false"
                                aria-controls="genques-collapseFour">
                                Як відправляти самому запити для моніторингу в Linux Python скриптом?
                            </button>
                        </h2>
                        <div id="genques-collapseFour" class="accordion-collapse collapse"
                            aria-labelledby="info-Python" data-bs-parent="#genques-accordion">
                            <div class="accordion-body">
                                Ось <a href="/"> посилання на Github</a> де ви знайдете сам код скрипта для запитів. Також за допомогою цього скрипта зможете зібрати додаток для своєї платформи
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="info-Windows">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#genques-collapseFive" aria-expanded="false"
                                aria-controls="genques-collapseFive">
                                 Як відправляти самому запити для моніторингу в Windows?
                            </button>
                        </h2>
                        <div id="genques-collapseFive" class="accordion-collapse collapse"
                            aria-labelledby="info-Windows" data-bs-parent="#genques-accordion">
                            <div class="accordion-body">
                                Якщо у вас не має можливості запустити скрипт для моніторингу в <a href="#info-Cron">Linux</a>, то ось <a href="/"> посилання на Github</a> де ви знайдете простеньку програму Windows для моніторингу створену із  <a href="/"> Python коду</a>.
                                Недолік, вона повинна бути постійно запущена на увімкненому ПК.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="info-PHP">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#genques-collapseFour6" aria-expanded="false"
                                    aria-controls="genques-collapseFour6">
                                Як відправляти самому запити для моніторингу PHP скриптом?
                            </button>
                        </h2>
                        <div id="genques-collapseFour6" class="accordion-collapse collapse"
                             aria-labelledby="info-PHP" data-bs-parent="#genques-accordion">
                            <div class="accordion-body">
                                <pre class="language-markup">
                                        <code class="language-markup">
function curlGetHttps($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if ($error) {
        return "Error: " . $error;
    } else {
        return $response;
    }
}
// Приклад визову функції
$url = "ВАШЕ ПОСИЛАННЯ"; // Замінити на своє посилання URL для потрібного будинку
$response = curlGetHttps($url);
if (is_string($response)) {
    echo "Response:\n" . $response;
} else {
    echo "Error: Could not get response.";
}

                                    </code>
                                 </pre>
                            </div>
                        </div>
                    </div>
                <!--end accordion-->
            </div>
        </div>
        <!--end row-->
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4">
                <h5 class="card-title mb-3">Управління акаунтом</h5>
                <p class="text-muted">Як користуватись особистим кабінетом</p>
            </div>
            <!--end col-->
            <div class="col-xl-8">
                <div class="accordion accordion-border-box" id="manageaccount-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="manageaccount-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#manageaccount-collapseOne" aria-expanded="false"
                                aria-controls="manageaccount-collapseOne">
                                Як створити новий акаунт?
                            </button>
                        </h2>
                        <div id="manageaccount-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="manageaccount-headingOne" data-bs-parent="#manageaccount-accordion">
                            <div class="accordion-body">
                                Натисніть на <a href="/register">це посилання</a>, щоб створити новий акаунт.
                                Далі в провому верхньому куті натисніть на іконку людини і перейдіть в <a href="/profile">"Профіль"</a>, де в "Мої будинки" ви зможете натиснути "Додати будинок"
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="manageaccount-headingTwo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#manageaccount-collapseTwo" aria-expanded="true"
                                aria-controls="manageaccount-collapseTwo">
                                Особистий кабінет
                            </button>
                        </h2>
                        <div id="manageaccount-collapseTwo" class="accordion-collapse collapse "
                            aria-labelledby="manageaccount-headingTwo" data-bs-parent="#manageaccount-accordion">
                            <div class="accordion-body">
                                Особистий кабінет максимально спрощений і всі додаткові налаштування ви зможете знайти в <a href="/profile">"Профіль"</a>.
                            </div>
                        </div>
                    </div>


                </div>
                <!--end accordion-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<!--ene card-->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4">
                <h5 class="card-title mb-3">Конфіденційність і безпека </h5>
                <p class="text-muted">Коротенько про зберігання ваших даних і доступу до них. Відповіді на питання по роботі сайту і обробки даних</p>
            </div>
            <!--end col-->
            <div class="col-xl-8">
                <div class="accordion accordion-border-box" id="privacy-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="privacy-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#privacy-collapseOne" aria-expanded="true"
                                aria-controls="privacy-collapseOne">
                                Чи мають треті особи доступ до вашої інформації?
                            </button>
                        </h2>
                        <div id="privacy-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="privacy-headingOne" data-bs-parent="#privacy-accordion">
                            <div class="accordion-body">
                               <strong>Ні</strong>. Доступ до даних має тільки та особо яка їх додавала. Більше ми нікому їх не надаємо.
                                Та іформації, що від вас надходить це тільки ваш IP якщо ви його вказали, якщо ви відправляєте запит на посилання API
                                ми тільки зберігаємо час отримання такого запиту.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="privacy-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#privacy-collapseTwo" aria-expanded="false"
                                aria-controls="privacy-collapseTwo">
                                Чи можу я надати доступ до свого моніторингу іншим особам?
                            </button>
                        </h2>
                        <div id="privacy-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="privacy-headingTwo" data-bs-parent="#privacy-accordion">
                            <div class="accordion-body">
                                Так. Якщо під час додавання адреси чи при редагуванні ви вибере створити публічне посилання. Якщо ви його скопіюєте,
                                зможете надіслати іншим особам і їм не потрібно реєструватись на сайті щоб бачити вашу статистику.
                            </div>
                        </div>
                    </div>

                </div>
                <!--end accordion-->
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<!-- App js -->
<script src="{{ URL::asset('/build/js/app.js') }}"></script>
@endsection
