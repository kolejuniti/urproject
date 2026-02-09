<!doctype html>
<html lang="ms">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Kampus Anda - Kolej UNITI</title>

    <!-- Meta -->
    <meta name="description" content="Pilih kampus Kolej UNITI pilihan anda - Port Dickson atau Kota Bharu. Pengajian diploma diiktiraf MQA.">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ku1.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-pd: #1e40af;
            /* Port Dickson Blue */
            --primary-kb: #065f46;
            /* Kota Bharu Green */
            --accent: #f59e0b;
            /* Amber/Gold Shared */
            --text-main: #1e293b;
            --font-main: 'Outfit', sans-serif;
        }

        body {
            font-family: var(--font-main);
            color: var(--text-main);
            overflow-x: hidden;
            background: #f8fafc;
        }

        .split-container {
            min-height: 100vh;
            display: flex;
            position: relative;
        }

        .split-side {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s ease;
            overflow: hidden;
            min-height: 50vh;
            /* Mobile Default */
        }

        .split-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            transition: all 0.5s ease;
        }

        /* Port Dickson Side */
        .side-pd {
            background: url('https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/sd1.png') no-repeat center center/cover;
            border-right: 2px solid white;
        }

        .side-pd::before {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.9), rgba(30, 58, 138, 0.8));
        }

        /* Kota Bharu Side */
        .side-kb {
            background: url('https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/stkukb.png') no-repeat center center/cover;
            border-left: 2px solid white;
        }

        .side-kb::before {
            background: linear-gradient(135deg, rgba(6, 95, 70, 0.9), rgba(6, 78, 59, 0.8));
        }

        .content-box {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 3rem;
            max-width: 500px;
            transform: translateY(20px);
            opacity: 0.9;
            transition: all 0.4s ease;
        }

        .campus-logo {
            height: 80px;
            margin-bottom: 1.5rem;
            /* filter: brightness(0) invert(1); */
        }

        .btn-custom {
            padding: 0.75rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1.5rem;
            transition: all 0.3s;
            border: 2px solid white;
            color: white;
            background: transparent;
        }

        .btn-custom:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .side-pd .btn-custom:hover {
            color: var(--primary-pd);
        }

        .side-kb .btn-custom:hover {
            color: var(--primary-kb);
        }

        /* Hover Effects on Desktop */
        @media (min-width: 992px) {
            .split-side:hover {
                flex: 1.5;
            }

            .split-side:hover::before {
                opacity: 0.85;
            }

            .split-side:hover .content-box {
                transform: translateY(0);
                opacity: 1;
                scale: 1.05;
            }

            .side-pd:hover {
                border-right-width: 0;
            }

            .side-kb:hover {
                border-left-width: 0;
            }
        }

        /* Unique Center Divider Logo */
        .center-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            background: white;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            border: 4px solid white;
        }

        .center-logo img {
            width: 55px;
            height: auto;
        }

        @media (max-width: 991px) {
            .split-container {
                flex-direction: column;
            }

            .center-logo {
                width: 80px;
                height: 80px;
            }

            .center-logo img {
                width: 45px;
            }

            .side-pd,
            .side-kb {
                border: none;
                border-bottom: 2px solid white;
            }
        }

        .tracking-wider {
            letter-spacing: 3px;
        }
    </style>
</head>

<body>

    <!-- Center Logo (Absolute) -->
    <!-- <div class="center-logo animate__animated animate__zoomIn">
        <a href="#">
            <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ku1.png" alt="UNITI Logo">
        </a>
    </div> -->

    <div class="split-container">

        <!-- Left Side: Port Dickson -->
        <div class="split-side side-pd" onclick="window.location.href='{{ route('student.kupd', ['source' => request('source'), 'ref' => request('ref')]) }}'">
            <div class="content-box" data-aos="fade-right">
                <h3 class="fw-light text-uppercase tracking-wider mb-2">Kolej UNITI</h3>
                <h2 class="fw-bold display-6 mb-3">Port Dickson</h2>
                <p class="lead mb-4 opacity-75">Terdapat 16 program diploma yang terdiri daripada tiga fakulti.</p>
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('student.kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-custom">Lihat Kampus</a>
                    <a href="{{ route('student.register-kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="text-white text-decoration-underline small opacity-75 hover-opacity-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Right Side: Kota Bharu -->
        <div class="split-side side-kb" onclick="window.location.href='{{ route('student.kukb', ['source' => request('source'), 'ref' => request('ref')]) }}'">
            <div class="content-box" data-aos="fade-left">
                <h3 class="fw-light text-uppercase tracking-wider mb-2">Kolej UNITI</h3>
                <h2 class="fw-bold display-6 mb-3">Kota Bharu</h2>
                <p class="lead mb-4 opacity-75">Menawarkan 7 program diploma dalam pelbagai bidang.</p>
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('student.kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-custom">Lihat Kampus</a>
                    <a href="{{ route('student.register-kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="text-white text-decoration-underline small opacity-75 hover-opacity-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>