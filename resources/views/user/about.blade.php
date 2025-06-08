@extends('user.base.base')

@push('styles')
    <style>
        body {
            background-color: #fdf8ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .about-container {
            max-width: 960px;
            margin: 4rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(60, 19, 97, 0.15);
        }

        .about-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .about-header h1 {
            font-size: 2.5rem;
            color: #3C1361;
            font-weight: bold;
        }

        .about-header p {
            font-size: 1.1rem;
            color: #555;
        }

        .about-section {
            margin-bottom: 2rem;
        }

        .about-section h2 {
            color: #3C1361;
            font-size: 1.6rem;
            margin-bottom: 0.8rem;
        }

        .about-section p {
            color: #666;
            line-height: 1.7;
        }

        .team-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 2rem;
        }

        .team-member {
            flex: 1 1 240px;
            background: #f8f3ff;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(60, 19, 97, 0.08);
        }

        .team-member img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .team-member h4 {
            margin: 0.5rem 0 0.3rem;
            color: #3C1361;
        }

        .team-member p {
            color: #777;
            font-size: 0.9rem;
        }

        @media (max-width: 600px) {
            .about-header h1 {
                font-size: 2rem;
            }

            .about-section h2 {
                font-size: 1.3rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="about-container">
        <div class="about-header">
            <h1>About Amethyshelf</h1>
            <p>Your trusted bookstore to discover knowledge, passion, and imagination.</p>
        </div>

        <div class="about-section">
            <h2>Who We Are</h2>
            <p>Amethyshelf is an Indonesian-based online bookstore offering a curated selection of books for children,
                students, and book lovers alike. We’re passionate about bringing stories and knowledge to every corner of
                the nation through affordable and accessible books.</p>
        </div>

        <div class="about-section">
            <h2>Our Mission</h2>
            <p>Our mission is to make books accessible to everyone — from rare children’s titles to modern bestsellers. We
                value learning, curiosity, and the joy of reading, and we aim to deliver those values through every order we
                pack and ship.</p>
        </div>

        <div class="about-section">
            <h2>Our Team Members</h2>
            <div class="team-container">
                <div class="team-member">
                    <h4>Evelin Alim</h4>
                    <p>0706022310021</p>
                </div>
                <div class="team-member">
                    <h4>Felicia Kathrin</h4>
                    <p>0706022310002</p>
                </div>
                <div class="team-member">
                    <h4>Angeline</h4>
                    <p>0706022310006</p>
                </div>
                <div class="team-member">
                    <h4>Varrel Tjandra</h4>
                    <p>0706022310017</p>
                </div>
                <div class="team-member">
                    <h4>Talitha Celin</h4>
                    <p>0706022310019</p>
                </div>
            </div>
        </div>
    </div>
@endsection
