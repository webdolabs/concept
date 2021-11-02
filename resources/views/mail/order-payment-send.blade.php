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
                <div style="color: #DC2626;">
                    Vaše objednávka {{ $email['order']->billing_number }} není zaplacená!
                </div>
                <div style="color: #6B7280; padding-top: 1rem;">
                    Vaše objednávka ještě není bohužel zaplacena a proto Vám posíláme údaje k zaplacení objednávky bankovním převodem.
                </div>
        </div>
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