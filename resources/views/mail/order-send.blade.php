<div>
    <style>
        @media(max-width: 640px) {
            .mobile-hide {
                display: none;
            }
        }
        @media(min-width: 640px) {
            .desktop-hide {
                display: none;
            }
        }
    </style>
    <div style="max-width: 40rem; margin: 2rem auto;">
        <div style="padding: 1rem; background: #fff">
                <img style="height: 4rem" src="https://www.petrolwear.cz/img/logo-web.png" alt="">
        </div>
        <div style="padding: 2rem; border-width: 1px; border-color: #E5E7EB">
                <div style="color: #169151;">
                    Vaše objednávka z eshopu petrolwear.cz byla úspěšně přijata.
                </div>
                <div style="color: #6B7280; padding-top: 1rem;">
                    @if($email['order']->payment_type == "banktransfer")
                        Vybrali jste si platbu pomocí bankovního převodu. Hned co příjmeme platbu na našem účtu zásílku odešleme a zašleme sledovací kód, abyste věděli, kdy k vám objednávka dorazí.
                    @else
                        Jak jen to bude možné, zásílku odešleme a zašleme sledovací kód, abyste věděli, kdy k vám objednávka dorazí.
                    @endif
                </div>
        </div>
        <div style="background: #F3F4F6; padding: 1rem 2rem; border-width: 0px 1px 1px 1px; border-color: #E5E7EB">
            <div style="letter-spacing: 0.025em;color: #000; font-size: 1.4rem; font-weight: bold">
                Vaše objednávka
            </div>
            <div style="color: #6B7280; padding: 1rem 0;">
                <table style="width: 100%;">
                        <thead style="color: #000; border-bottom: 1px solid #D1D5DB; padding: 16px 0">
                            <tr>
                                <td class="mobile-hide" style="padding-bottom: 4px"></td>
                                <td style="padding-bottom: 4px">Název</td>
                                <td class="mobile-hide" style="text-align: right;padding-bottom: 4px">Počet</td>
                                <td style="text-align: right;padding-bottom: 4px">Cena dohromady</td>
                            </tr>
                        </thead>
                        <tbody style="font-weight: light; font-size: 14px">
                            @foreach($email['products'] as $product)
                                <tr>
                                    <td class="mobile-hide" style="padding: 12px 4px 0 4px;">{{ $loop->iteration }}.</td>
                                    <td style="padding-top: 12px">
                                        {{ $product->sub_name ? $product->name . ' - ' . $product->sub_name : $product->sub_name }}
                                    </td>
                                    <td class="mobile-hide" style="text-align: right;padding-top: 12px">
                                        {{ $product->quantity }} ks
                                    </td>
                                    <td style="text-align: right;padding-top: 12px">{{ $product->price_VAT * $product->quantity }} Kč</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
                <table style="width: 100%; text-align: left">
                    <tbody style="font-weight: light; font-size: 14px">
                        @if($email['order']->shipping->price_VAT > 0)
                            <tr>
                                <td class="mobile-hide" style="padding-top: 12px; width: 60%"></td>
                                <td style="padding-top: 12px">Doprava</td>
                                <td style="text-align: right;padding-top: 12px">{{ $email['order']->shipping_price_VAT }}</td>
                            </tr>
                        @endif
                        @if($email['order']->payment->price_VAT > 0)
                            <tr>
                                <td class="mobile-hide" style="padding-top: 12px; width: 60%"></td>
                                <td style="padding-top: 12px">Dobírka</td>
                                <td style="text-align: right;padding-top: 12px">{{ $email['order']->payment_price_VAT }}</td>
                            </tr>
                        @endif
                        <tr style="color: #000; font-weight: bold; font-size: 16px">
                            <td class="mobile-hide" style="padding-top: 12px; width: 60%"></td>
                            <td style="padding-top: 12px">Celkem</td>
                            <td style="text-align: right;padding-top: 12px">{{ $email['order']->total_VAT }} Kč</td>
                        </tr>
                    </tbody>
                </table>
                <div style="padding-top: 12px;">
                    Způsob dopravy: <span style="color: #000;">{{ $email['order']->shipping->label }}</span>
                </div>
            </div>
        </div>
        @if($email['order']->payment_type == "banktransfer")
            <div style="background: #111827; padding: 1rem 2rem;">
                <div style="letter-spacing: 0.025em;color: #fff; font-size: 1.4rem; font-weight: bold">
                    Platba
                </div>
                <table style="color: #fff;width: 100%; margin-bottom: 1rem;">
                    <tr style="font-weight: normal; font-size: 16px">
                        <td style="line-height: 2">
                            Číslo účtu: <strong>235277039/0600</strong><br>
                            Variabilní symbol: <strong>{{ $email['order']->billing_number }}</strong><br>
                            Cena: <strong>{{ $email['order']->total_VAT }} Kč</strong><br><br>
                        </td>
                        <td class="mobile-hide" style="text-align: right;">
                            <img style="float: right;width: 13rem;height: 13rem;" src="https://api.paylibo.com/paylibo/generator/czech/image?accountNumber=235277039&bankCode=0600&amount={{ $email['order']->total_VAT }}.00&currency=CZK&vs={{ $email['order']->billing_number }}&message=QR%20PLATBA" alt="">
                        </td>
                    </tr>
                    <tr class="desktop-hide" style="font-weight: normal; padding-top: 16px">
                        <td style=" padding-top: 16px">
                            <img style="float: right; width: 13rem;height: 13rem;" src="https://api.paylibo.com/paylibo/generator/czech/image?accountNumber=235277039&bankCode=0600&amount={{ $email['order']->total_VAT }}.00&currency=CZK&vs={{ $email['order']->billing_number }}&message=QR%20PLATBA" alt="">
                        </td>
                    </tr>
                </table>
            </div>
        @endif
        <div style="color: #000; padding: 2rem; text-align: center">
            V případě že potřebujete poradit ozvěte se nám:
            info@petrolwear.cz 
            +420735057550
        </div>
    </div>
    <div style="font-size: 14px; padding: 2rem; border-top: 1px solid #E5E7EB;color: #6B7280;">
        Ondřej Štěpán <br>
        Veřovice 11, Veřovice, 74273 <br>
        zapsaný v živnostenském rejstříku Městského úřadu Frenštát pod Radhoštěm <br>
        IČ: 07799322 <br>
        <a href="https://www.petrolwear.cz/stranka/reklamace-a-vraceni" style="color: #DC2626; text-decoration: underline">Reklamace a vrácení</a>, 
        <a href="https://www.petrolwear.cz/stranka/obchodni-podminky" style="color: #DC2626; text-decoration: underline">Obchodní podmínky</a>
    </div>
</div>