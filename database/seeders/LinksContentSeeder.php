<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LinksContent;
    
class LinksContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'key' => 'RESPONSIBLE_GAMING',
                'value' => 'Responsible Gaming',
                'data' => '
            <p>Mention name of the governing authority that manages lottery-based gaming in Myanmar region is strongly committed to finding the right balance between profitability and social responsibility. Working collaboratively, we are putting that commitment into action. Therefore, <strong>company name</strong> has introduced a number of initiatives designed to promote the safe use of our products.</p>

            <p>More specifically, we pay the greatest attention in the following fields:</p>

            <ul>
                <li>Full information for players (brochures for game rules, odds of winning and playing / prize claiming procedures)</li>
                <li>Staff training</li>
                <li>Dissemination of draw results</li>
                <li>Responsible gaming signage in the POS</li>
                <li>Protection of winner’s privacy</li>
                <li>Responsible communication (targeted only in adult population)</li>
                <li>Availability and communication of support services (for players playing excessively)</li>
            </ul>

            <p>Last but not least, we have designed codes of practice protecting the player and retailer relations, rights and transactions, as well as an advertising code of practice which outlines our guidelines towards responsible communication.</p>

            <p>The sales and participants codes of practice are available at the retail outlets for players’ and retailers’ review.</p>
            '
            ],




            [
                'key' => 'PRIVACY_POLICY',
                'value' => 'Privacy Policy',
                'data' => '
            <h3>Privacy Policy</h>

            <h4>Introduction</h4>

            <p>We are committed to protecting your privacy and keeping you informed about how we use your data. This Privacy Policy includes details of how we collect personal data from you and how we use it to provide a personalised service to you.</p>

            <p>The website is operated by Galaxy Group Ltd, Intershore Chambers, Road Town, Tortola, British Virgin Islands, who will be processing payments for Galaxy Group Ltd is licensed and regulated by the Government of Curacao, license #365/ JAZ. The website is owned by.Marcat Limited a company incorporated in the Isle of Man (Company Number 132016C) Fotysdene, Ballavitchel Road, Isle of Man, IM42DN.</p>

            <p>By registering a Player Account with the Website, you confirm your acceptance of this Privacy Policy. If you do not agree with the terms of this Privacy Policy and do not wish to provide us with the personal information we require, please do not use this website.</p>

            <h4>Information we collect</h4>

            <p>The Personal Information which we may request to use and process shall include, without limitation:</p>

            <ol>
                <li>Any of the information that you provide to us when filling in the forms on our account registration pages, as well as any other data that you further submit via the Website or email (e.g. first and last name, date of birth, email address, phone number, bank details, password);</li>
                <li>Correspondence made with us via the Website, email, web chat or through other means of communication.</li>
                <li>All Player Account transaction history, whether this takes place via the Website(s) or via other means of communication.</li>
                <li>Website logins and their details, including traffic data, GeoIP location data, browser/device data, weblogs, activity logs and other traffic information recorded in our system.</li>
                <li>Documents and proofs reasonably requested by us to verify your account, to process deposits or withdrawals and to conduct anti-fraud checks (on our own initiative or as required by applicable legislation). Such proofs may include passport scans, payment slips, bank statements, etc.</li>
                <li>Survey participations or other customer assessments that we may carry out from time to time.</li>
            </ol>

            <p>The website wls.infinitilotto.com shall keep all personal information you give us strictly confidential and no personal information shall be made available to third parties, unless obliged by law to do so, by consent or legal process. This site may use cookies to customize it and make your visit to us more user friendly. Cookies cannot harm your computer in any way and is an industry standard; however, no risk or liability shall be attributed to wls.infinitilotto.com for your use of cookies. Furthermore, our users may configure their browsers not to accept our cookies. The website wls.infinitilotto.com may send email messages to its customers with news and special.</p>

            <p>We are committed to providing 100% secure services to ensure that no data is stolen, lost, or misused.</p>

            <h4>Disclaimer</h4>

            <p>Although the wls.infinitilotto.com shall endeavour to provide accurate, up to date and truthful information on this site neither the wls.infinitilotto.com nor any of its employees, directors, shareholders, agents, contractors and associates make any representations or give any warranties, whether expressly, tacitly or implied, as to the operation of the site, the information, content, materials and products included and available from this site. The wls.infinitilotto.com, its employees, directors, shareholders, contractors, agents and associates shall not be liable for any claim, loss or damage of whatsoever nature arising or resulting from the use of or inability to use this site or the information contained herein, including but not limited to direct, indirect, incidental, special, punitive and consequential damages.</p>

            <h4>Editorial Control</h4>

            <p>This website may contain content provided by third parties and hyperlinks to other sites. wls.infinitilotto.com does not screen or filter such content or the other sites or information available from those other sites and therefore does not accept any liability, without limitation, for defamatory, illegal or criminal content contained on such sites. wls.infinitilotto.com encourages its users to report any infringement, illegal or criminal content found on any of the sites available through links from this site in order to investigate whether such a link should be removed.</p>

            <h4>Changes to User Agreement</h4>

            <p>Please note that this Privacy Policy constitutes an agreement between you and the Company. The wls.infinitilotto.com reserves the right to make changes to this site and this user agreement, terms and conditions at any time without notice. We recommend that you visit our Privacy Policy regularly. Your continued use of the website and/or its services will constitute your acceptance of the Privacy Policy.</p>
            '
            ],




            [
                'key' => 'TERMS_CONDITIONS',
                'value' => 'Terms & Conditions',
                'data' => '

            <p>Welcome to the online lottery. In order to keep you informed of the membership benefits, please read the agreement carefully before registering for membership and using <strong>wls.infinitilotto.com</strong>. Members have read and accept the "Website Terms and Conditions of Service".</p>

            <h4>Online Betting Treatment and Assistance</h4>
            <p>If a member leaves the website during betting, your account will not affect the outcome of the bet.
            
            Dont worry If members leave the website during betting Members will be logged out for a period of time. Then the members can log in to wls.infinitilotto.com again as usual.</p>

            <h4>Protection</h4>
            <p>wls.infinitilotto.com has prepared Efficient system Speed and friendly customer service If you have any questions or suggestions, please dont hesitate to call the customer service. Which will be available 24 hours a day, 7 days a week, and we will respond as quickly as possible. wls.infinitilotto.com guarantees to keep your personal information confidential.</p>

            <h4>Betting Terms</h4>
            <p>To avoid various problems while using the website Members, please read the company rules carefully and carefully. When members enter the betting page, the company will assume that you have accepted the terms of wls.infinitilotto.com.</p>

            <p>Bets must be on "Specified period" otherwise it will be the same time as "null and void" if the bet is canceled or timeout. Due to any reason before playing That bet will be considered "void" and the company will return the credit to the member.</p>

            <p>It is the responsibility of the members to keep an eye on the results. From the window that shows the result of the bet, lose or win The company will uphold the data. "Betting details" of members in the event that they are in doubt And want to check the calculation information of that bet.</p>

            <p>If a system error occurs during betting or an unintentional mistake by the employee The company reserves the right to amend the results correctly. And the edited text will be printed on the runner bar on the website. The company will not notify members personally.</p>

            <p>It is members responsibility to make sure that the username and password for accessing the website are correct. And please change your member password at least once a month For safety If you find or suspect that someone has accessed your account without your permission, please notify your representative immediately to change your personal code. (If there is a bet before changing the original code, that bet will be considered as a result.)</p>

            <p>Before each bet start Members should check your limit first. If you have any queries About the limit Please notify your member representative immediately.</p>

            <p>In the event that an unexpected event occurs, such as data loss due to an internet crash The company will announce the cause. And how to solve problems.</p>

            <p>Service hours 24 hours / day and no days off



            <h4>Security System</h4>
            <p>Accounting information for personal purposes Information that members provide when opening accounts is kept to the maximum confidentiality. The company will not share this information with any third parties or other organizations, such as email accounts. Or other information That the members fill out in the application This information will only be used for the intended purpose, such as sending cash checks for winners or other information. As requested by members</p>

            <p>Security The company has used the most effective methods to ensure you the security of your information. We will try our best to maintain accuracy. And confidentiality of information To prevent information from being leaked or misused If you have any queries Relating to confidentiality Data security Please contact customer service. We are happy to service 24 hours / day, every day, no holiday.</p>

            <p>The company is very pleased to serve you.</p>

            '
            ],
        ];

        foreach ($links as $link) {
            LinksContent::updateOrCreate(['key' => $link['key']], [
                'value' => $link['value'],
                'data' => $link['data']
            ]);
        }
    }
}
