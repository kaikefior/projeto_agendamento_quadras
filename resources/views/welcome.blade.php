<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f4ef">
    <title>Quadras de areia | {{ config('app.name', 'Beach') }}</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #18332f;
            --muted: #6c7b75;
            --paper: #f5f4ef;
            --card: #fffefa;
            --line: #e5e7df;
            --green: #16745a;
            --green-dark: #10533f;
            --lime: #d6ed9a;
            --orange: #e67c54;
            --sand: #f2d7a8;
        }

        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: "Segoe UI", Arial, sans-serif; font-size: 16px; }
        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }
        .topbar { background: var(--paper); border-bottom: 1px solid var(--line); }
        .nav { width: min(1180px, calc(100% - 40px)); height: 76px; margin: auto; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
        .brand { display: flex; align-items: center; gap: 11px; font-size: 19px; font-weight: 800; letter-spacing: -.04em; }
        .nav-links { display: flex; align-items: center; gap: 30px; color: #52635c; font-size: 14px; font-weight: 650; }
        .nav-links a:hover { color: var(--green); }
        .nav-actions { display: flex; align-items: center; gap: 10px; }
        .button { min-height: 43px; display: inline-flex; align-items: center; justify-content: center; padding: 0 19px; border: 1px solid transparent; border-radius: 8px; font-size: 14px; font-weight: 700;  }
        .button-quiet { border-color: #d7ddd4; background: transparent; }
        .button-primary { background: var(--green); color: white; }
        .button-primary:hover { background: var(--green-dark); }
        .hero-wrap { padding: 36px 20px 0; }
        .hero { position: relative; overflow: hidden; width: min(1180px, 100%); min-height: 338px; margin: auto; padding: 48px 56px; display: grid; grid-template-columns: 1fr; justify-items: center; align-items: center; border-radius: 30px; background: #174d3d; color: white; text-align: center; }
        .hero-copy { position: relative; z-index: 1; max-width: 760px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 8px; margin: 0 auto 18px; color: #d6ed9a; font-size: 12px; font-weight: 750; letter-spacing: .1em; text-transform: uppercase; }

        h1 { max-width: 540px; margin: 0; font-size: clamp(36px, 5vw, 58px); line-height: .99; letter-spacing: -.055em; }
        .hero-copy p { max-width: 520px; margin: 19px auto 25px; color: #d3e1d7; font-size: 17px; line-height: 1.7; }
        .hero .button-primary { background: var(--lime); color: #18332f; box-shadow: none; }
        .hero .button-primary:hover { background: #e2f5b7; }
        .hero-note { display: block; margin: 13px auto 0; color: #ccddd1; font-size: 14px; }
        .page { width: min(1180px, calc(100% - 40px)); margin: 0 auto; }
        .booking-section { position: relative; z-index: 2; margin-top: -24px; padding: 0 18px; }
        .booking-panel { padding: 27px 30px 30px; border: 1px solid rgba(24, 51, 47, .08); border-radius: 24px; background: var(--card); box-shadow: 0 18px 45px rgba(33, 48, 40, .08); }
        .booking-heading { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 21px; }
        .section-kicker { margin: 0 0 7px; color: var(--green); font-size: 12px; font-weight: 750; letter-spacing: .1em; text-transform: uppercase; }
        h2 { margin: 0; font-size: 30px; letter-spacing: -.035em; }
        .subheading { margin: 7px 0 0; color: var(--muted); font-size: 15px; }
        .date-month { margin-bottom: 12px; color: #596a62; font-size: 14px; font-weight: 650; text-align: center; text-transform: capitalize; }
        .date-row { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 9px; }
        .date-option { min-height: 72px; display: grid; align-content: center; justify-items: center; gap: 4px; border: 1px solid transparent; border-radius: 8px; background: #f4f5f0; color: #6b7972; cursor: pointer; }
        .date-option:hover { border-color: #c6d8c6; }
        .date-option.is-active { border-color: var(--green); background: var(--green); color: white; box-shadow: 0 8px 18px rgba(22,116,90,.16); }
        .date-option .day { font-size: 22px; font-weight: 700; line-height: 1; }
        .date-option .weekday { font-size: 11px; font-weight: 650; letter-spacing: .06em; text-transform: uppercase; }
        .court-list { display: grid; gap: 14px; margin-top: 24px; }
        .court-card { padding: 20px; border: 1px solid var(--line); border-radius: 18px; background: #fff; }
        .court-info { display: flex; align-items: center; gap: 14px; margin-bottom: 17px; }
        .court-title { margin: 0; font-size: 19px; font-weight: 700; letter-spacing: -.02em; }
        .court-type { margin: 5px 0 0; color: var(--muted); font-size: 14px; }
        .court-status { margin-left: auto; color: #75847b; font-size: 13px; font-weight: 650; }
        .slots { display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); gap: 9px; }
        .slot { min-height: 76px; padding: 12px 10px; display: grid; align-content: center; justify-items: start; gap: 8px; border: 1px solid #e8ebe5; border-radius: 8px; background: #fffefa; color: var(--ink); cursor: pointer; }
        .slot:hover:not(:disabled) { border-color: #71a68d; }
        .slot.is-selected { border-color: var(--green); background: #eff7ed; box-shadow: inset 0 0 0 1px var(--green); }
        .slot:disabled { background: #f4f4f1; color: #9ba39e; cursor: not-allowed; }
        .slot-time { font-size: 14px; font-weight: 650; white-space: nowrap; }
        .slot-price { color: var(--green); font-size: 14px; font-weight: 700; }
        .slot-unavailable { color: #929b95; font-size: 11px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
        .booking-footer { display: flex; align-items: center; justify-content: space-between; gap: 18px; margin-top: 21px; padding-top: 19px; border-top: 1px solid var(--line); }
        .selection-hint { color: var(--muted); font-size: 14px; }
        .selection-hint strong { color: var(--ink); }
        .reserve-button[aria-disabled="true"] { background: #b8c2ba; box-shadow: none; cursor: not-allowed; pointer-events: none; }
        .steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; padding: 62px 18px 66px; }
        .step { padding: 21px; border: 1px solid rgba(24,51,47,.08); border-radius: 17px; background: rgba(255,254,250,.72); }
        .step-number { color: var(--orange); font-size: 12px; font-weight: 700; letter-spacing: .1em; }
        .step h3 { margin: 11px 0 6px; font-size: 17px; }
        .step p { margin: 0; color: var(--muted); font-size: 14px; line-height: 1.65; }
        footer { border-top: 1px solid rgba(24,51,47,.09); color: var(--muted); font-size: 13px; }
        .footer-inner { width: min(1180px, calc(100% - 40px)); margin: auto; padding: 21px 0; display: flex; justify-content: space-between; gap: 15px; }

        @media (max-width: 850px) {
            .nav-links { display: none; }
            .hero { min-height: 310px; padding: 38px; }
            .slots { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .date-row { grid-template-columns: repeat(7, minmax(52px, 1fr)); overflow-x: auto; padding-bottom: 5px; }
        }
        @media (max-width: 600px) {
            .nav { width: calc(100% - 28px); height: 66px; }
            .brand { font-size: 16px; }
            .nav-actions { gap: 7px; }
            .nav-actions .button { min-height: 38px; padding: 0 13px; font-size: 11px; }
            .hero-wrap { padding: 16px 12px 0; }
            .hero { min-height: 0; padding: 31px 24px 27px; grid-template-columns: 1fr; border-radius: 23px; }
            h1 { max-width: 400px; font-size: 42px; }
            .hero-copy p { margin: 14px 0 19px; font-size: 13px; }
            .hero-note { display: block; margin: 12px 0 0; }
            .page { width: calc(100% - 24px); }
            .booking-section { margin-top: 15px; padding: 0; }
            .booking-panel { padding: 21px 15px; border-radius: 19px; }
            .booking-heading { align-items: start; flex-direction: column; gap: 14px; }
            h2 { font-size: 24px; }
            .date-month { text-align: left; }
            .date-row { grid-template-columns: repeat(7, 57px); gap: 7px; }
            .date-option { min-height: 65px; }
            .court-card { padding: 15px 12px; }
            .court-info { gap: 10px; }
            .court-status { font-size: 9px; }
            .slots { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 7px; }
            .slot { min-height: 68px; padding: 10px 9px; }
            .booking-footer { align-items: stretch; flex-direction: column; }
            .booking-footer .button { width: 100%; }
            .steps { grid-template-columns: 1fr; gap: 9px; padding: 34px 0 42px; }
            .step { padding: 17px; }
            .footer-inner { width: calc(100% - 28px); flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body>
    <header class="topbar">
        <nav class="nav" aria-label="Navegação principal">
            <a class="brand" href="{{ route('home') }}">Beach Club</a>
            <div class="nav-links">
                <a href="#reservar">Reservar quadra</a>
                <a href="#como-funciona">Como funciona</a>
            </div>
            <div class="nav-actions">
                @if (Route::has('login'))
                    @auth
                        <a class="button button-quiet" href="{{ url('/dashboard') }}">Minha conta</a>
                    @else
                        <a class="button button-quiet" href="{{ route('login') }}">Entrar</a>
                        @if (Route::has('register'))
                            <a class="button button-primary" href="{{ route('register') }}">Criar conta</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <main>
        <div class="hero-wrap">
            <section class="hero" aria-labelledby="hero-title">
                <div class="hero-copy">
                    <span class="eyebrow">Seu próximo jogo começa aqui</span>
                    <h1 id="hero-title">Areia, sol e jogo marcado.</h1>
                    <p>Encontre uma quadra, escolha o melhor horário e reúna sua turma. A diversão fica por nossa conta.</p>
                    <a class="button button-primary" href="#reservar">Ver horários disponíveis <span aria-hidden="true" style="margin-left:9px">→</span></a>
                    <span class="hero-note">Futevôlei · Beach tennis · Vôlei de praia</span>
                </div>
            </section>
        </div>

        <div class="page">
            <section class="booking-section" id="reservar" aria-labelledby="booking-title">
                <div class="booking-panel">
                    <div class="booking-heading">
                        <div>
                            <p class="section-kicker">Agendamento rápido</p>
                            <h2 id="booking-title">Agende seu horário</h2>
                            <p class="subheading">Escolha uma data e confira os horários de cada quadra.</p>
                        </div>
                        <a class="button button-quiet" href="{{ Route::has('login') ? route('login') : '#' }}">Como reservar?</a>
                    </div>

                    @php
                        $today = now()->locale('pt_BR')->startOfDay();
                        $days = [];
                        for ($i = 0; $i < 7; $i++) {
                            $days[] = $today->copy()->addDays($i);
                        }
                        $courts = [
                            ['name' => 'Quadra 1', 'type' => 'Futevôlei · Beach tennis · Vôlei de praia', 'slots' => [['16:00', true], ['17:00', true], ['18:00', true], ['19:00', false], ['20:00', false], ['21:00', true]]],
                            ['name' => 'Quadra 2', 'type' => 'Futevôlei · Beach tennis · Vôlei de praia', 'slots' => [['16:00', true], ['17:00', false], ['18:00', true], ['19:00', true], ['20:00', true], ['21:00', false]]],
                        ];
                    @endphp

                    <p class="date-month">{{ $today->translatedFormat('F Y') }}</p>
                    <div class="date-row" role="group" aria-label="Escolha o dia">
                        @foreach ($days as $index => $day)
                            <button class="date-option {{ $index === 0 ? 'is-active' : '' }}" type="button" aria-pressed="{{ $index === 0 ? 'true' : 'false' }}" data-date="{{ $day->toDateString() }}">
                                <span class="day">{{ $day->format('d') }}</span>
                                <span class="weekday">{{ $day->translatedFormat('D') }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="court-list">
                        @foreach ($courts as $court)
                            @php
                                $freeSlots = 0;
                                foreach ($court['slots'] as $slot) {
                                    if ($slot[1]) {
                                        $freeSlots++;
                                    }
                                }
                            @endphp
                            <article class="court-card">
                                <div class="court-info">

                                    <div>
                                        <h3 class="court-title">{{ $court['name'] }}</h3>
                                        <p class="court-type">{{ $court['type'] }}</p>
                                    </div>
                                    <span class="court-status">{{ $freeSlots }} horários livres</span>
                                </div>
                                <div class="slots" role="group" aria-label="Horários da {{ $court['name'] }}">
                                    @foreach ($court['slots'] as [$start, $available])
                                        @php($end = sprintf('%02d:00', ((int) substr($start, 0, 2)) + 1))
                                        @if ($available)
                                            <button class="slot" type="button" data-court="{{ $court['name'] }}" data-time="{{ $start }} às {{ $end }}" aria-pressed="false">
                                                <span class="slot-time">{{ $start }} às {{ $end }}</span>
                                                <span class="slot-price">R$ 100,00</span>
                                            </button>
                                        @else
                                            <button class="slot" type="button" disabled aria-label="{{ $start }} às {{ $end }}, ocupado">
                                                <span class="slot-time">{{ $start }} às {{ $end }}</span>
                                                <span class="slot-unavailable">Ocupado</span>
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="booking-footer">
                        <p class="selection-hint" id="selection-hint" aria-live="polite">Selecione um horário para continuar.</p>
                        @if (Route::has('login'))
                            <a class="button button-primary reserve-button" id="reserve-button" aria-disabled="true" href="{{ route('login') }}">Entrar para reservar <span aria-hidden="true" style="margin-left:9px">→</span></a>
                        @else
                            <span class="button button-primary reserve-button" aria-disabled="true">Reservar horário</span>
                        @endif
                    </div>
                </div>
            </section>

            <section class="steps" id="como-funciona" aria-label="Como funciona a reserva">
                <article class="step"><span class="step-number">01 / ESCOLHA</span><h3>Escolha o dia</h3><p>Veja as datas disponíveis e encontre a melhor para sua turma.</p></article>
                <article class="step"><span class="step-number">02 / RESERVE</span><h3>Selecione a quadra</h3><p>Compare os horários livres e escolha onde quer jogar.</p></article>
                <article class="step"><span class="step-number">03 / JOGUE</span><h3>Confirme sua reserva</h3><p>Entre na sua conta para concluir o agendamento com praticidade.</p></article>
            </section>
        </div>
    </main>

    <footer>
        <div class="footer-inner"><span>© {{ now()->year }} Beach Club</span><span>Feito para quem gosta de jogar junto.</span></div>
    </footer>

    <script>
        var dates = document.querySelectorAll('.date-option');

        for (var i = 0; i < dates.length; i++) {
            dates[i].onclick = function () {
                for (var j = 0; j < dates.length; j++) {
                    dates[j].classList.remove('is-active');
                }
                this.classList.add('is-active');
                this.setAttribute('aria-pressed', 'true');
                for (var k = 0; k < dates.length; k++) {
                    if (dates[k] !== this) {
                        dates[k].setAttribute('aria-pressed', 'false');
                    }
                }
            };
        }

        var slots = document.querySelectorAll('.slot:not(:disabled)');
        var hint = document.getElementById('selection-hint');
        var reserveButton = document.getElementById('reserve-button');

        for (var i = 0; i < slots.length; i++) {
            slots[i].onclick = function () {
                for (var j = 0; j < slots.length; j++) {
                    slots[j].classList.remove('is-selected');
                }
                this.classList.add('is-selected');
                this.setAttribute('aria-pressed', 'true');
                for (var k = 0; k < slots.length; k++) {
                    if (slots[k] !== this) {
                        slots[k].setAttribute('aria-pressed', 'false');
                    }
                }

                var selectedDate = document.querySelector('.date-option.is-active .day').textContent;
                hint.innerHTML = '<strong>' + this.getAttribute('data-court') + '</strong> · ' + this.getAttribute('data-time') + ' · dia ' + selectedDate;

                if (reserveButton) {
                    reserveButton.setAttribute('aria-disabled', 'false');
                }
            };
        }
    </script>
</body>
</html>
