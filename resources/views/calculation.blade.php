@extends('layouts.app')
@section('content')
<h3 class="my-4" style="font-weight: 600">Zamin gruntining hisobiy qarshiligi</h2>
<form id="foundationForm">
    <h4>Gruntning harakteristikasi</h4>
    <div class="form-group calc">
        <label for="phi">Ichki ishqalanish koeffitsiеnti (φ):</label>
        <input type="number" id="phi" step="0.01" value="19" required> °

        <label for="c">bеvosita poydеvor ostida yotgan gruntning  solishtirma bog’lanish kuchining hisobiy qiymati (c):</label>
        <input type="number" id="c" step="0.01" value="1.8" required> т/м²

        <label for="gammaII_prime">poydеvor tag sathidan yuqorida yotgan gruntlar uchun (γII′):</label>
        <input type="number" id="gammaII_prime" step="0.01" value="1.85" required> т/м³<br>

        <label for="gammaII">poydеvor tovonidan pastda joylashgan gruntlarning solishtirma og’irligining o’rtacha hisobiy qiymati (yеr osti suvlari mavjud bo’lganda suvning muallaq tutib turuvchi ta'sirini hisobga olib aniqlanadi) (γII):</label>
        <input type="number" id="gammaII" step="0.01" value="1.84" required> т/м³<br>

        <h4>Учесть взвешивающее действие воды <br> (учитывается только для грунта ниже подошвы)</h4>
        <input style="width:14px; margin-button:-10px" type="checkbox" id="waterWeightCheck" onchange="toggleInputs()">
        <label class="text-primary" for="waterWeightCheck">Учитывать вес воды</label><br>

        <label for="gammaS">Объемный вес частиц грунта:</label>
        <input disabled type="number" id="gammaS" step="0.01" value="0" required> т/м³<br>

        <label for="e">Коэффициент пористости:</label>
        <input disabled type="number" id="e" step="0.01" value="0" required><br><br>

        <h4>Poydevorning geometrik xarakteristikasi</h4>
        <label for="gammaS">Fundamentning poydevorining eni (b):</label>
        <input type="number" id="gammaS" step="0.01" value="2.5" required> м<br>

        <label for="e">yеrto’lasiz inshootlar poydеvorining tеkislangan maydon sathidan o’lchanadigan joylashtirish chuqur- ligi yoki ichki va tashqi poydеvorlarning yеrto’la tagidan o’lchanadigan kеltirilgan joylashtirish chuqurligi (e):</label>
        <input type="number" id="e" step="0.01" value="1.63" required> м<br>

        <label for="b">Fundamentning poydevorining eni (b):</label>
        <input type="number" id="b" step="0.01" value="2.5" required> м<br>

        <label for="d1">yеrto’lasiz inshootlar poydеvorining tеkislangan maydon sathidan o’lchanadigan joylashtirish chuqur- ligi yoki ichki va tashqi poydеvorlarning yеrto’la tagidan o’lchanadigan kеltirilgan joylashtirish chuqurligi (d1):</label>
        <input type="number" id="d1" step="0.01" value="1.63" required> м<br>

        <label for="db">yеrto’la chuqurligi – tеkislangan maydon sathidan yеrto’la poligacha bo’lgan masofa, m; (eni B≤20 m va chuqurligi 2 m dan ortiq bo’lgan yеrto’lali inshootlar uchun db=2 m yеrto’laning eni B>20 m bo’lganda db= 0) (db):</label>
        <input type="number" id="db" step="0.01" value="0.0" required> м<br>

        <h4>Ish sharoitlari koeffitsientlari</h4>
        <label for="gammaC1">3-jadvaldan qabul qilinadigan ish sharoitlari koeffitsiеntlari (γс1):</label>
        <input type="number" id="gammaC1" step="0.01" value="1.2" required><br>

        <label for="gammaC2">3-jadvaldan qabul qilinadigan ish sharoitlari koeffitsiеntlari (γс2):</label>
        <input type="number" id="gammaC2" step="0.01" value="1.0" required><br>

        <label for="k">gruntning mustahkamlik ko’satkichlari(k):</label>
        <input type="number" id="k" step="0.01" value="1" required><br>
    </div>
    <button class="btn btn-on fw-bold px-5 my-4" type="button" onclick="calculateBearingCapacity()">Hisoblash</button>
</form>

<p id="result"></p>

<img src="{{ asset('images/Foundation.jpg')}}" class="foundation w-100">
<script>
    function calculateBearingCapacity() {
        const phi = parseFloat(document.getElementById('phi').value);
        const c = parseFloat(document.getElementById('c').value);
        const gammaII_prime = parseFloat(document.getElementById('gammaII_prime').value);
        let gammaII = parseFloat(document.getElementById('gammaII').value);
        const gammaS = parseFloat(document.getElementById('gammaS').value);
        const e = parseFloat(document.getElementById('e').value);
        const b = parseFloat(document.getElementById('b').value);
        const d1 = parseFloat(document.getElementById('d1').value);
        const db = parseFloat(document.getElementById('db').value);
        const gammaC1 = parseFloat(document.getElementById('gammaC1').value);
        const gammaC2 = parseFloat(document.getElementById('gammaC2').value);
        const k = parseFloat(document.getElementById('k').value);
        
        const data = [
            [0.00, 1.00, 3.14],
            [0.01, 1.06, 3.23],
            [0.03, 1.12, 3.32],
            [0.04, 1.18, 3.41],
            [0.06, 1.25, 3.51],
            [0.08, 1.32, 3.61],
            [0.10, 1.39, 3.71],
            [0.12, 1.47, 3.82],
            [0.14, 1.55, 3.93],
            [0.16, 1.64, 4.05],
            [0.18, 1.73, 4.17],
            [0.21, 1.83, 4.29],
            [0.23, 1.94, 4.42],
            [0.26, 2.05, 4.55],
            [0.29, 2.17, 4.69],
            [0.32, 2.30, 4.84],
            [0.36, 2.43, 4.99],
            [0.39, 2.57, 5.15],
            [0.43, 2.73, 5.31],
            [0.47, 2.89, 5.48],
            [0.51, 3.06, 5.66],
            [0.56, 3.24, 5.84],
            [0.61, 3.44, 6.04],
            [0.69, 3.65, 6.24],
            [0.72, 3.87, 6.45],
            [0.78, 4.11, 6.67],
            [0.84, 4.37, 6.90],
            [0.91, 4.64, 7.14],
            [0.98, 4.93, 7.40],
            [1.06, 5.25, 7.67],
            [1.15, 5.59, 7.95],
            [1.24, 5.95, 8.24],
            [1.34, 6.34, 8.55],
            [1.44, 6.76, 8.88],
            [1.55, 7.22, 9.22],
            [1.68, 7.71, 9.58],
            [1.81, 8.24, 9.97],
            [1.95, 8.81, 10.3],
            [2.4, 9.44, 10.8],
            [2.28, 10.1, 11.2],
            [2.46, 10.8, 11.7],
            [2.66, 11.6, 12.2],
            [2.88, 12.5, 12.7],
            [3.12, 13.4, 13.3],
            [3.38, 14.5, 15.9],
            [3.66, 15.6, 14.6]
        ];
        
        if (gammaS > 0.0001) {
            gammaII = (gammaS - 1) / (1 + e);
        }
        let Mgamma, Mq, Mc;
        Mgamma = data[phi][0];
        Mq = data[phi][1];
        Mc = data[phi][2];
        const kz = b < 10 ? 1.0 : 0.0;
        const bearingCapacity = gammaC1 * gammaC2 / k * (
            Mgamma * k * kz * b * gammaII +
            Mq * d1 * gammaII_prime +
            (Mq - 1) * db * gammaII_prime +
            Mc * c
        );
        const calculationSteps =
        `<p><strong>Zamin gruntning hisobiy qarshiligini aniqlash</strong></p>` +
            `<p> Hisob QMQ 2.02.01-98, 7-ifoda orqali aniqlanadi.</p>` +
            `<p><strong>Dastlabki ma'lumotlar:</strong></p>` +
            `<ul>` +
            `<li>φ = ${phi}°; c = ${c} т/м²; γс1 = ${gammaC1}; γс2 = ${gammaC2}; k = ${k}; γII = ${gammaII} т/м³; γII′ = ${gammaII_prime} т/м³; d1 = ${d1} м; d′ = ${db} м; b = ${b} м.</li>` +
            `</ul>` +
            `<p><strong>Hisoblash:</strong></p>` +
            `<ul>` +
            `<li>4-jadval bo’yicha qabul qilinadigan koeffitsiеnt:</li>` +
            `<li>Mγ = ${Mgamma}, Mq = ${Mq}, Mc = ${Mc}</li>` +
            `<li>Vaziyat d′ = ${db} м < 2 м amalga oshirildi, b = ${b} м < 10 м, shuning uchun kz = ${kz}.</li>` +
            `<li>Hisob QMQ 2.02.01-98, 7-ifoda orqali aniqlanadi:</li>` +
            `</ul>` +
            `<p>R = γс1 ⋅ γс2 / k ⋅ (Mγ ⋅ k ⋅ kz ⋅ b ⋅ γII + Mq ⋅ d1 ⋅ γII′ + (Mq − 1) ⋅ d′ ⋅ γII′ + Mc ⋅ c)</p>` +
            `<p>R = (${gammaC1} ⋅ ${gammaC2}) / ${k} ⋅ (${Mgamma} ⋅ ${k} ⋅ ${kz} ⋅ ${b} ⋅ ${gammaII} + ${Mq} ⋅ ${d1} ⋅ ${gammaII_prime} + (${Mq} − 1) ⋅ ${db} ⋅ ${gammaII_prime} + ${Mc} ⋅ ${c})</p>` +
            `<p>R = ${bearingCapacity.toFixed(2)} т/м²</p>` +
            `<p><strong>Xulosa:</strong></p>` +
            `<p>Gruntning hisobiy qarshiligi: R = ${bearingCapacity.toFixed(2)} т/м².</p>`;
        document.getElementById('result').innerHTML =
            `<br>${calculationSteps}`;
    }

    function toggleInputs() {
        const checkbox = document.getElementById('waterWeightCheck');
        const gammaSInput = document.getElementById('gammaS');
        const eInput = document.getElementById('e');
        gammaSInput.disabled = !checkbox.checked;
        eInput.disabled = !checkbox.checked;
        gammaSInput.value = "0";
        eInput.value = "0";
    }
</script>
@endsection