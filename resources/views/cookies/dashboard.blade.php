@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @guest
        @if (!request()->hasCookie('cookie_consent') || request()->cookie('cookie_consent') !== 'aceptado')
            <div id="cookie-banner" class="cookie-banner" role="group" aria-label="Acciones">
                <p>Este sitio web utiliza cookies para mejorar su experiencia de usuario y analizar de forma anónima y
                    estadística el uso que hace de la web. Para más información, acceda a la <a
                        href="https://www.exteriores.gob.es/es/Paginas/Cookies.aspx" target="_blank"
                        style="color: #0280ff; text-decoration: underline;">Política de
                        Cookies</a>.<br><br>Al hacer clic en <b>ACEPTAR</b>, usted acepta el uso de todas las cookies.</p>
                <br><br>
                <a href="{{ route('setCookie') }}" class="btn btn-success" id="accept-btn">Aceptar</a>

                <form action="{{ url('/del-cookie') }}" class="d-inline" method="get">
                    @csrf
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro?')" value="Rechazar">
                </form>
            </div>
            <script>
                document.getElementById('accept-btn').addEventListener('click', function() {
                    document.getElementById('cookie-banner').style.display = 'none';
                });
            </script>
        @endif
    @endguest

    @unlessrole('admin')
        <!-- Tapas Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Tapas Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Tapas</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line mb-5"></div>
                    <div class="divider-custom-icon mb-5"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line mb-5"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">

                    @foreach ($barTapaWithTotalVotos as $barTapa)
                        <!-- Portfolio Item 1-->
                        <div class="col-md-6 col-lg-4 mb-5">

                            <div class="portfolio-item mx-auto" data-bs-toggle="modal"
                                data-bs-target="#portfolioModal{{ $barTapa['bartapa_Id'] }}">
                                <div
                                    class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                    <div class="portfolio-item-caption-content text-center text-white"><i
                                            class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('storage/' . $barTapa['img']) }}"
                                    style="max-width: 100%; height: auto; margin: 0 auto;" width="200px"
                                    alt="{{ $barTapa['tapa'] }}" />

                            </div>
                            <div class="table-container mt-3">
                                <table>
                                    <tr>
                                        <th>Tapa:</th>
                                        <td>{{ $barTapa['tapa'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bar:</th>
                                        <td>{{ $barTapa['bar'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Votos:</th>
                                        <td>{{ $barTapa['stars'] }} ({{ $barTapa['totalVotos'] }} votos)</td>
                                    </tr>

                                    <tr>
                                        <th>Opiniones:</th>
                                        <td>&nbsp;
                                            <button class="btn show-opinions-btn mb-3 mt-2 shadow"
                                                style="background-color:  #a5b6a5;color: white;"><i
                                                    class="fas fa-eye"></i></button>



                                            <div class="opinions-section" style="display: none;">

                                                @if (isset($barTapa['comments']) && count($barTapa['comments']) > 0)
                                                    <table class="table" style="border: 1px solid #dee2e6;">
                                                        <thead>
                                                            <tr>
                                                                <th>Comentarios</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($barTapa['comments'] as $comment)
                                                                <tr>
                                                                    <td>{{ $comment->comment }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table" style="border: 1px solid #dee2e6;">
                                                        <thead>
                                                            <tr>
                                                                <th>Comentarios</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>No hay opiniones. ¡Sé el primero en
                                                                    comentar!</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>



                                </table>
                            </div>

                        </div>
                        <!-- Portfolio Modal 1-->
                        <div class="portfolio-modal modal fade" id="portfolioModal{{ $barTapa['bartapa_Id'] }}" tabindex="-1"
                            aria-labelledby="portfolioModal{{ $barTapa['bartapa_Id'] }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header border-0"><button class="btn-close" type="button"
                                            data-bs-dismiss="modal" aria-label="Close"></button></div>
                                    <div class="modal-body text-center pb-5">
                                        <div class "container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-8">
                                                    <!--  Modal - Title-->
                                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tapa
                                                    </h2>
                                                    <!-- Icon Divider-->
                                                    <div class="divider-custom">
                                                        <div class="divider-custom-line"></div>
                                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                                        <div class="divider-custom-line"></div>
                                                    </div>
                                                    <!--  Modal - Image-->
                                                    <img class="img-fluid rounded mb-5"
                                                        src="{{ asset('storage/' . $barTapa['img']) }}"
                                                        alt="{{ $barTapa['tapa'] }}" />
                                                    <!--  Modal - Text-->

                                                    <div class="table-responsive" style="margin-left: 2px;">
                                                        <table class="table table-borderless">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Nombre tapa:</th>
                                                                    <td>{{ $barTapa['tapa'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Descripción:</th>
                                                                    <td>{{ $barTapa['description'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nombre bar:</th>
                                                                    <td>{{ $barTapa['bar'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Dirección:</th>
                                                                    <td>{{ $barTapa['address'] }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="text-center">
                                                        <button class="btn"
                                                            style="background-color: var(--bs-blue);color: white;"
                                                            data-bs-dismiss="modal">

                                                            <i class="fas fa-xmark fa-fw"></i>
                                                            Cerrar
                                                        </button>

                                                        <a href="{{ route('voto.create', $barTapa['bartapa_Id']) }}"
                                                            class="btn btn-success mb-3 mt-3">Vota</a>

                                                        <a href="{{ route('map', $barTapa['bartapa_Id']) }}"
                                                            class="btn mb-3 mt-3 shadow"
                                                            style="background-color: #a5b6a5; color: white; display: inline-block; line-height: 20px;height: 40px;"
                                                            title="Ver Mapa" onmouseover="this.style.backgroundColor='#f1458d'"
                                                            onmouseout="this.style.backgroundColor='#a5b6a5'; return false;">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                        </a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-6 col-lg-12"></div>

                </div>
                <div class="d-flex justify-content-center">
                    {{ $barTapas->links() }}
                </div>
        </section>
        <!-- About Section-->
        <section class="page-section text-white mb-0" id="info" style="background-color: var(--bs-custom);">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Tapea y Gana</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ms-auto">
                        <p class="lead">La misión de Ruta de la Tapa es promover la cultura de las tapas en toda España,
                            permitiendo a los usuarios descubrir nuevas tapas y compartir sus favoritas con la comunidad.</p>
                        <p class="lead">Nuestra visión es ser el principal recurso en línea para los amantes de las tapas,
                            proporcionando una experiencia interactiva y enriquecedora que fomente el amor por la gastronomía.
                        </p>
                    </div>
                    <div class="col-lg-4 me-auto">
                        <p class="lead">A través de Tapea y Gana, puedes incentivar la participación al premiar a quienes
                            votan en tu ruta. Tenemos un sistema opcional de premios directos para hacerlo aún más divertido.
                            ¿Estás listo para descubrir nuevas tapas y unirte a la comunidad Ruta de la Tapa? Visita nuestra
                            web o <a href="#contacto" style="color: #2C3E50; text-decoration: underline;">contacta con
                                nosotros
                            </a>
                            hoy mismo y comienza tu viaje gastronómico.</p>
                    </div>
                </div>
                </a>
            </div>
            </div>
        </section>
        <!-- Contact Section-->
        <section class="page-section" id="contacto">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contáctanos</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text"
                                    placeholder="Introduzca su nombre..." data-sb-validations="required" />
                                <label for="name">Nombre y Apellidos</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">Un nombre es obligatorio.
                                </div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com"
                                    data-sb-validations="required,email" />
                                <label for="email">Email</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">El email es obligatorio.
                                </div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email no válido.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(+34) 111222333"
                                    data-sb-validations="required" />
                                <label for="phone">Télefono</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">Un teléfono es obligatorio.
                                </div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..."
                                    style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Mensaje</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">Escriba un mensaje.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Mensaje enviado con éxito</div>
                                    <br />
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage">
                                <div class="text-center text-danger mb-3">Error al enviar el mensaje!</div>
                            </div>
                            <!-- Submit Button-->

                            <button class="btn btn-xl disabled shadow"
                                style="border: none; background-color: var(--bs-custom);box-shadow: 1px 8px 16px 1px rgba(0,0,0,0.5);"
                                id="submitButton" type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>


    @endunless
@endsection

@section('scripts')
    @if (!request()->hasCookie('cookie_consent'))
        <script>
            document.getElementById('accept-btn').addEventListener('click', function() {
                document.getElementById('cookie-banner').style.display = 'none';
            });
        </script>
    @endif
    <!---script para mostrar contenido despues de hacer clic en el botón ver----------------->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let showOpinionsButtons = document.querySelectorAll('.show-opinions-btn');
            showOpinionsButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let opinionsSection = this.nextElementSibling;

                    if (opinionsSection.style.display === 'none' || opinionsSection.style
                        .display === '') {
                        opinionsSection.style.display = 'table-row';
                    } else {
                        opinionsSection.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <style>
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 999;
        }


        .cookie-banner button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
        }

        .cookie-banner button:hover {
            background-color: #3e8e41;
        }

        .portfolio .portfolio-item .portfolio-item-caption {
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.2s ease-in-out;
            opacity: 0;
            background-color: #a5b6a5;
        }
    </style>
