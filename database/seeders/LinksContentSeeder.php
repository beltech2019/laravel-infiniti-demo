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
            // RESPONSIBLE_GAMING
            [
                'key' => 'RESPONSIBLE_GAMING',
                'value' => 'Responsible Gaming',
                'lang' => 'en',
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
                'key' => 'RESPONSIBLE_GAMING',
                'value' => 'Jeu Responsable',
                'lang' => 'fr',
                'data' => '
                    <p>Le nom de l’autorité de régulation qui gère les jeux de loterie dans la région du Myanmar s’engage fortement à trouver le juste équilibre entre rentabilité et responsabilité sociale. En travaillant de manière collaborative, nous mettons cet engagement en action. Par conséquent, <strong>nom de l’entreprise</strong> a mis en place plusieurs initiatives visant à promouvoir l’utilisation sécurisée de nos produits.</p>

                    <p>Plus précisément, nous portons la plus grande attention aux domaines suivants :</p>

                    <ul>
                        <li>Informations complètes pour les joueurs (brochures sur les règles du jeu, les probabilités de gains et les procédures de jeu / de réclamation des prix)</li>
                        <li>Formation du personnel</li>
                        <li>Diffusion des résultats des tirages</li>
                        <li>Signalétique sur le jeu responsable dans les points de vente</li>
                        <li>Protection de la vie privée des gagnants</li>
                        <li>Communication responsable (ciblée uniquement sur la population adulte)</li>
                        <li>Disponibilité et communication des services de soutien (pour les joueurs jouant de manière excessive)</li>
                    </ul>

                    <p>Enfin, nous avons conçu des codes de pratique protégeant les relations, droits et transactions des joueurs et des détaillants, ainsi qu’un code de pratique publicitaire définissant nos lignes directrices pour une communication responsable.</p>

                    <p>Les codes de pratique des ventes et des participants sont disponibles dans les points de vente pour consultation par les joueurs et les détaillants.</p>
                '
            ],


            [
                'key' => 'RESPONSIBLE_GAMING',
                'value' => 'Juego Responsable',
                'lang' => 'es',
                'data' => '
                    <p>El nombre de la autoridad reguladora que gestiona los juegos de lotería en la región de Myanmar está firmemente comprometido a encontrar el equilibrio adecuado entre rentabilidad y responsabilidad social. Trabajando en colaboración, estamos poniendo en práctica ese compromiso. Por lo tanto, <strong>nombre de la empresa</strong> ha introducido varias iniciativas destinadas a promover el uso seguro de nuestros productos.</p>

                    <p>Más específicamente, prestamos la mayor atención en los siguientes ámbitos:</p>

                    <ul>
                        <li>Información completa para los jugadores (folletos con reglas del juego, probabilidades de ganar y procedimientos de participación / reclamación de premios)</li>
                        <li>Capacitación del personal</li>
                        <li>Difusión de los resultados de los sorteos</li>
                        <li>Señalización de juego responsable en los puntos de venta</li>
                        <li>Protección de la privacidad de los ganadores</li>
                        <li>Comunicación responsable (dirigida únicamente a la población adulta)</li>
                        <li>Disponibilidad y comunicación de servicios de apoyo (para jugadores que juegan en exceso)</li>
                    </ul>

                    <p>Por último, hemos diseñado códigos de práctica que protegen las relaciones, derechos y transacciones entre jugadores y minoristas, así como un código de práctica publicitaria que define nuestras pautas hacia una comunicación responsable.</p>

                    <p>Los códigos de práctica de ventas y de participación están disponibles en los puntos de venta para la revisión de jugadores y minoristas.</p>
                '
            ],



            [
                'key' => 'RESPONSIBLE_GAMING',
                'value' => 'การเล่นเกมอย่างมีความรับผิดชอบ',
                'lang' => 'th',
                'data' => '
                    <p>ชื่อของหน่วยงานกำกับดูแลที่ดูแลการเล่นเกมลอตเตอรีในภูมิภาคเมียนมา มีความมุ่งมั่นอย่างยิ่งในการสร้างสมดุลที่เหมาะสมระหว่างความสามารถในการทำกำไรและความรับผิดชอบต่อสังคม โดยการทำงานร่วมกัน เรากำลังทำให้คำมั่นสัญญานี้เป็นจริง ดังนั้น <strong>ชื่อบริษัท</strong> จึงได้แนะนำโครงการหลายอย่างที่ออกแบบมาเพื่อส่งเสริมการใช้งานผลิตภัณฑ์ของเราอย่างปลอดภัย</p>

                    <p>โดยเฉพาะอย่างยิ่ง เราให้ความสำคัญสูงสุดในด้านต่าง ๆ ดังต่อไปนี้:</p>

                    <ul>
                        <li>ข้อมูลที่ครบถ้วนสำหรับผู้เล่น (โบรชัวร์กฎของเกม, โอกาสในการชนะ และขั้นตอนการเล่น / การขอรับรางวัล)</li>
                        <li>การฝึกอบรมพนักงาน</li>
                        <li>การเผยแพร่ผลการออกรางวัล</li>
                        <li>ป้ายประชาสัมพันธ์เกี่ยวกับการเล่นเกมอย่างมีความรับผิดชอบในจุดขาย</li>
                        <li>การปกป้องความเป็นส่วนตัวของผู้ชนะ</li>
                        <li>การสื่อสารอย่างมีความรับผิดชอบ (เจาะกลุ่มเฉพาะประชากรผู้ใหญ่)</li>
                        <li>การมีอยู่และการสื่อสารบริการช่วยเหลือ (สำหรับผู้เล่นที่เล่นมากเกินไป)</li>
                    </ul>

                    <p>สุดท้าย เราได้ออกแบบแนวทางปฏิบัติในการคุ้มครองความสัมพันธ์ สิทธิ์ และธุรกรรมระหว่างผู้เล่นและผู้ค้าปลีก รวมถึงแนวทางปฏิบัติด้านการโฆษณาที่กำหนดแนวทางของเราในการสื่อสารอย่างมีความรับผิดชอบ</p>

                    <p>แนวทางปฏิบัติด้านการขายและการมีส่วนร่วมมีให้บริการที่ร้านค้าปลีกเพื่อให้ผู้เล่นและผู้ค้าปลีกตรวจสอบได้</p>
                '
            ],


            // PRIVACY_POLICY
            [
                'key' => 'PRIVACY_POLICY',
                'value' => 'Privacy Policy',
                'lang' => 'en',
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
                'key' => 'PRIVACY_POLICY',
                'value' => 'Politique de Confidentialité',
                'lang' => 'fr',
                'data' => '
                    <h3>Politique de Confidentialité</h3>

                    <h4>Introduction</h4>
                    <p>Nous nous engageons à protéger votre vie privée et à vous informer sur la manière dont nous utilisons vos données. Cette Politique de Confidentialité décrit comment nous collectons vos données personnelles et comment nous les utilisons pour vous offrir un service personnalisé.</p>

                    <p>Le site est exploité par Galaxy Group Ltd, Intershore Chambers, Road Town, Tortola, Îles Vierges Britanniques, qui traite les paiements pour Galaxy Group Ltd, agréé et réglementé par le gouvernement de Curaçao, licence #365/JAZ. Le site est détenu par Marcat Limited, une société incorporée sur l’île de Man (numéro d’entreprise 132016C) Fotysdene, Ballavitchel Road, Isle of Man, IM42DN.</p>

                    <p>En enregistrant un compte joueur sur le site, vous confirmez votre acceptation de cette Politique de Confidentialité. Si vous n’êtes pas d’accord avec les termes de cette Politique et ne souhaitez pas fournir les informations personnelles requises, veuillez ne pas utiliser ce site.</p>

                    <h4>Informations que nous collectons</h4>
                    <p>Les informations personnelles que nous pouvons demander d’utiliser et de traiter comprennent, sans s’y limiter :</p>
                    <ol>
                        <li>Les informations fournies lors de l’inscription sur le site, ainsi que toutes autres données soumises via le site ou par email (ex. prénom, nom, date de naissance, adresse email, téléphone, coordonnées bancaires, mot de passe) ;</li>
                        <li>La correspondance effectuée avec nous via le site, email, chat en ligne ou autres moyens de communication.</li>
                        <li>L’historique complet des transactions de compte joueur.</li>
                        <li>Les connexions au site, y compris données de trafic, localisation GeoIP, données du navigateur/appareil, journaux d’activité, etc.</li>
                        <li>Les documents et justificatifs demandés pour vérifier votre compte, traiter des dépôts ou retraits, et effectuer des contrôles anti-fraude.</li>
                        <li>Les enquêtes ou autres évaluations clients auxquelles vous participez.</li>
                    </ol>

                    <p>Le site wls.infinitilotto.com conservera toutes les informations personnelles strictement confidentielles et ne les communiquera à des tiers que si la loi l’exige, par consentement ou procédure légale. Ce site peut utiliser des cookies pour personnaliser votre expérience. Les cookies ne peuvent pas endommager votre ordinateur et sont une norme de l’industrie.</p>

                    <p>Nous nous engageons à fournir des services 100% sécurisés afin qu’aucune donnée ne soit volée, perdue ou utilisée de manière abusive.</p>

                    <h4>Avertissement</h4>
                    <p>Bien que wls.infinitilotto.com s’efforce de fournir des informations exactes et à jour, ni wls.infinitilotto.com ni ses employés, administrateurs, actionnaires, agents ou partenaires ne garantissent l’exactitude ou l’exhaustivité des informations. Le site ne pourra être tenu responsable de tout dommage résultant de l’utilisation ou de l’impossibilité d’utiliser ce site.</p>

                    <h4>Contrôle éditorial</h4>
                    <p>Ce site peut contenir du contenu tiers et des liens vers d’autres sites. wls.infinitilotto.com ne filtre pas ces contenus et n’accepte aucune responsabilité pour les contenus diffamatoires, illégaux ou criminels qui y figurent. Nous encourageons les utilisateurs à signaler tout contenu inapproprié.</p>

                    <h4>Modifications</h4>
                    <p>Cette Politique de Confidentialité constitue un accord entre vous et l’entreprise. wls.infinitilotto.com se réserve le droit de modifier ce site et cette politique à tout moment sans préavis. Votre utilisation continue du site constitue votre acceptation des modifications.</p>
                '
            ],


            [
                'key' => 'PRIVACY_POLICY',
                'value' => 'Política de Privacidad',
                'lang' => 'es',
                'data' => '
                    <h3>Política de Privacidad</h3>

                    <h4>Introducción</h4>
                    <p>Estamos comprometidos a proteger su privacidad y mantenerlo informado sobre cómo usamos sus datos. Esta Política de Privacidad describe cómo recopilamos datos personales y cómo los utilizamos para brindarle un servicio personalizado.</p>

                    <p>El sitio web es operado por Galaxy Group Ltd, Intershore Chambers, Road Town, Tortola, Islas Vírgenes Británicas, que procesa pagos para Galaxy Group Ltd, autorizado y regulado por el Gobierno de Curazao, licencia #365/JAZ. El sitio es propiedad de Marcat Limited, una empresa registrada en la Isla de Man (número de empresa 132016C) Fotysdene, Ballavitchel Road, Isla de Man, IM42DN.</p>

                    <p>Al registrar una cuenta de jugador en el sitio, confirma su aceptación de esta Política de Privacidad. Si no está de acuerdo con los términos de esta Política y no desea proporcionar la información personal requerida, no utilice este sitio.</p>

                    <h4>Información que recopilamos</h4>
                    <p>La información personal que podemos solicitar y procesar incluye, entre otras:</p>
                    <ol>
                        <li>Cualquier información proporcionada al registrarse en el sitio (nombre, apellido, fecha de nacimiento, correo electrónico, teléfono, datos bancarios, contraseña);</li>
                        <li>Correspondencia realizada con nosotros a través del sitio, correo electrónico, chat en línea u otros medios.</li>
                        <li>Historial de transacciones de la cuenta de jugador.</li>
                        <li>Datos de inicio de sesión del sitio, incluidos tráfico, ubicación GeoIP, navegador/dispositivo, registros de actividad, etc.</li>
                        <li>Documentos solicitados para verificar su cuenta, procesar depósitos o retiros y realizar controles antifraude.</li>
                        <li>Encuestas u otras evaluaciones de clientes en las que participe.</li>
                    </ol>

                    <p>El sitio wls.infinitilotto.com mantendrá toda la información personal estrictamente confidencial y no la compartirá con terceros salvo obligación legal, consentimiento o proceso judicial. Este sitio puede usar cookies para personalizar su experiencia.</p>

                    <p>Estamos comprometidos a brindar servicios 100% seguros para garantizar que los datos no sean robados, perdidos ni mal utilizados.</p>

                    <h4>Descargo de responsabilidad</h4>
                    <p>Aunque wls.infinitilotto.com se esfuerza por proporcionar información precisa y actualizada, ni el sitio ni sus empleados, directores, accionistas, agentes o asociados garantizan su exactitud. El sitio no será responsable de daños derivados del uso o imposibilidad de uso de este sitio.</p>

                    <h4>Control editorial</h4>
                    <p>Este sitio puede contener contenido de terceros y enlaces a otros sitios. wls.infinitilotto.com no filtra dichos contenidos y no acepta responsabilidad por materiales difamatorios, ilegales o criminales. Animamos a los usuarios a reportar contenido inapropiado.</p>

                    <h4>Cambios</h4>
                    <p>Esta Política de Privacidad constituye un acuerdo entre usted y la empresa. wls.infinitilotto.com se reserva el derecho de modificar este sitio y esta política en cualquier momento sin previo aviso. El uso continuo del sitio constituye la aceptación de dichas modificaciones.</p>
                '
            ],


            [
                'key' => 'PRIVACY_POLICY',
                'value' => 'นโยบายความเป็นส่วนตัว',
                'lang' => 'th',
                'data' => '
                    <h3>นโยบายความเป็นส่วนตัว</h3>

                    <h4>บทนำ</h4>
                    <p>เรามุ่งมั่นที่จะปกป้องความเป็นส่วนตัวของคุณและแจ้งให้คุณทราบเกี่ยวกับวิธีการใช้ข้อมูลของคุณ นโยบายความเป็นส่วนตัวนี้อธิบายถึงวิธีการที่เรารวบรวมข้อมูลส่วนบุคคลและนำมาใช้เพื่อให้บริการที่เป็นส่วนตัวแก่คุณ</p>

                    <p>เว็บไซต์นี้ดำเนินการโดย Galaxy Group Ltd, Intershore Chambers, Road Town, Tortola, British Virgin Islands ซึ่งเป็นผู้ดำเนินการชำระเงินสำหรับ Galaxy Group Ltd ที่ได้รับอนุญาตและควบคุมโดยรัฐบาลคูราเซา ใบอนุญาต #365/JAZ เว็บไซต์นี้เป็นเจ้าของโดย Marcat Limited บริษัทจดทะเบียนใน Isle of Man (เลขทะเบียน 132016C) Fotysdene, Ballavitchel Road, Isle of Man, IM42DN.</p>

                    <p>โดยการลงทะเบียนบัญชีผู้เล่นบนเว็บไซต์ คุณยืนยันการยอมรับนโยบายความเป็นส่วนตัวนี้ หากคุณไม่เห็นด้วยกับเงื่อนไขและไม่ต้องการให้ข้อมูลส่วนบุคคลที่เราต้องการ โปรดอย่าใช้เว็บไซต์นี้</p>

                    <h4>ข้อมูลที่เรารวบรวม</h4>
                    <p>ข้อมูลส่วนบุคคลที่เราอาจร้องขอและนำมาใช้ ได้แก่:</p>
                    <ol>
                        <li>ข้อมูลที่คุณให้ไว้ขณะลงทะเบียน (เช่น ชื่อ-นามสกุล วันเกิด อีเมล เบอร์โทร รายละเอียดบัญชีธนาคาร รหัสผ่าน);</li>
                        <li>การติดต่อที่ทำกับเราผ่านเว็บไซต์ อีเมล แชท หรือช่องทางอื่น ๆ;</li>
                        <li>ประวัติการทำธุรกรรมทั้งหมดของบัญชีผู้เล่น;</li>
                        <li>ข้อมูลการเข้าสู่ระบบเว็บไซต์ เช่น ข้อมูลการใช้งาน การระบุตำแหน่ง GeoIP ข้อมูลเบราว์เซอร์/อุปกรณ์ บันทึกการใช้งาน ฯลฯ;</li>
                        <li>เอกสารที่ร้องขอเพื่อยืนยันบัญชี ดำเนินการฝาก/ถอน และตรวจสอบการทุจริต;</li>
                        <li>การสำรวจความคิดเห็นหรือการประเมินลูกค้าอื่น ๆ ที่คุณเข้าร่วม;</li>
                    </ol>

                    <p>เว็บไซต์ wls.infinitilotto.com จะเก็บข้อมูลส่วนบุคคลทั้งหมดไว้เป็นความลับและจะไม่เปิดเผยต่อบุคคลที่สาม ยกเว้นตามที่กฎหมายกำหนด ความยินยอม หรือกระบวนการทางกฎหมาย เว็บไซต์นี้อาจใช้คุกกี้เพื่อปรับแต่งประสบการณ์ของคุณ</p>

                    <p>เรามุ่งมั่นที่จะให้บริการที่ปลอดภัย 100% เพื่อให้มั่นใจว่าข้อมูลจะไม่ถูกขโมย สูญหาย หรือถูกนำไปใช้ในทางที่ผิด</p>

                    <h4>ข้อจำกัดความรับผิด</h4>
                    <p>แม้ว่า wls.infinitilotto.com จะพยายามอย่างเต็มที่ในการให้ข้อมูลที่ถูกต้องและเป็นปัจจุบัน แต่ทางเว็บไซต์และพนักงาน หุ้นส่วน ผู้ถือหุ้น หรือผู้เกี่ยวข้อง จะไม่รับผิดชอบต่อความเสียหายใด ๆ อันเกิดจากการใช้หรือไม่สามารถใช้เว็บไซต์นี้</p>

                    <h4>การควบคุมเนื้อหา</h4>
                    <p>เว็บไซต์นี้อาจมีเนื้อหาจากบุคคลที่สามและลิงก์ไปยังเว็บไซต์อื่น wls.infinitilotto.com จะไม่ตรวจสอบหรือกรองเนื้อหาดังกล่าว และไม่รับผิดชอบต่อเนื้อหาที่ผิดกฎหมายหรือไม่เหมาะสม ผู้ใช้สามารถรายงานเนื้อหาที่ละเมิดเพื่อให้เราพิจารณาการลบออก</p>

                    <h4>การเปลี่ยนแปลง</h4>
                    <p>นโยบายความเป็นส่วนตัวนี้ถือเป็นข้อตกลงระหว่างคุณและบริษัท wls.infinitilotto.com ขอสงวนสิทธิ์ในการเปลี่ยนแปลงเว็บไซต์และนโยบายนี้ได้ทุกเมื่อโดยไม่ต้องแจ้งให้ทราบ การใช้งานเว็บไซต์อย่างต่อเนื่องถือเป็นการยอมรับนโยบายนี้</p>
                '
            ],



            // TERMS_CONDITIONS
            [
                'key' => 'TERMS_CONDITIONS',
                'value' => 'Terms & Conditions',
                'lang' => 'en',
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


            [
                'key' => 'TERMS_CONDITIONS',
                'value' => 'Termes et Conditions',
                'lang' => 'fr',
                'data' => '
                    <p>Bienvenue sur la loterie en ligne. Afin de vous tenir informé des avantages liés à l’adhésion, veuillez lire attentivement l’accord avant de vous inscrire et d’utiliser <strong>wls.infinitilotto.com</strong>. Les membres ont lu et accepté les "Conditions générales du site".</p>

                    <h4>Traitement et assistance des paris en ligne</h4>
                    <p>Si un membre quitte le site pendant un pari, votre compte ne sera pas affecté par le résultat du pari.
                    Ne vous inquiétez pas. Si les membres quittent le site pendant un pari, ils seront déconnectés pendant un certain temps. Ensuite, ils pourront se reconnecter normalement à wls.infinitilotto.com.</p>

                    <h4>Protection</h4>
                    <p>wls.infinitilotto.com a préparé un système efficace, rapide et un service client amical. Si vous avez des questions ou des suggestions, n’hésitez pas à contacter le service client disponible 24h/24 et 7j/7. wls.infinitilotto.com garantit la confidentialité de vos informations personnelles.</p>

                    <h4>Conditions de pari</h4>
                    <p>Pour éviter divers problèmes lors de l’utilisation du site, veuillez lire attentivement les règles de l’entreprise. En accédant à la page de paris, la société considérera que vous avez accepté les conditions de wls.infinitilotto.com.</p>

                    <p>Les paris doivent être effectués dans la "période spécifiée", sinon ils seront considérés comme "nuls et non avenus". Si le pari est annulé ou expire pour une raison quelconque avant le jeu, il sera considéré comme "nul" et la société restituera le crédit au membre.</p>

                    <p>Il est de la responsabilité des membres de surveiller les résultats. La société conservera les "détails des paris" des membres en cas de doute ou de contestation des calculs.</p>

                    <p>En cas d’erreur système ou d’erreur involontaire de l’employé, la société se réserve le droit de corriger les résultats. Le texte corrigé sera publié sur la barre d’information du site. La société ne notifiera pas personnellement les membres.</p>

                    <p>Les membres doivent s’assurer que leur identifiant et mot de passe sont corrects et doivent changer leur mot de passe au moins une fois par mois. En cas de suspicion d’accès non autorisé, veuillez en informer immédiatement votre représentant.</p>

                    <p>Avant de parier, vérifiez vos limites. Pour toute question concernant les limites, contactez immédiatement votre représentant.</p>

                    <p>En cas d’événement imprévu, comme une perte de données due à une panne Internet, la société annoncera la cause et la solution.</p>

                    <p>Service disponible 24h/24 et 7j/7.</p>

                    <h4>Système de sécurité</h4>
                    <p>Les informations fournies lors de l’ouverture du compte sont traitées avec la plus grande confidentialité et ne seront pas partagées avec des tiers. Elles ne seront utilisées qu’aux fins prévues.</p>

                    <p>La société utilise les méthodes les plus efficaces pour assurer la sécurité de vos informations. Pour toute question, contactez notre service client disponible 24h/24 et 7j/7.</p>

                    <p>La société est ravie de vous servir.</p>
                '
            ],


            [
                'key' => 'TERMS_CONDITIONS',
                'value' => 'Términos y Condiciones',
                'lang' => 'es',
                'data' => '
                    <p>Bienvenido a la lotería en línea. Para mantenerlo informado sobre los beneficios de la membresía, lea cuidadosamente el acuerdo antes de registrarse y usar <strong>wls.infinitilotto.com</strong>. Los miembros han leído y aceptado los "Términos y Condiciones del sitio web".</p>

                    <h4>Tratamiento y asistencia en apuestas en línea</h4>
                    <p>Si un miembro abandona el sitio durante una apuesta, su cuenta no se verá afectada por el resultado. 
                    No se preocupe, si los miembros abandonan el sitio, serán desconectados por un tiempo y luego podrán iniciar sesión nuevamente.</p>

                    <h4>Protección</h4>
                    <p>wls.infinitilotto.com ha preparado un sistema eficiente, rápido y un servicio de atención al cliente amigable disponible las 24 horas del día, los 7 días de la semana. wls.infinitilotto.com garantiza mantener la confidencialidad de su información personal.</p>

                    <h4>Términos de apuestas</h4>
                    <p>Para evitar problemas al usar el sitio, lea cuidadosamente las reglas de la empresa. Al acceder a la página de apuestas, se considerará que ha aceptado las condiciones.</p>

                    <p>Las apuestas deben realizarse en el "período especificado". Si se cancelan o expiran antes de jugar, serán consideradas "nulas" y se devolverá el crédito al miembro.</p>

                    <p>Los miembros son responsables de revisar los resultados. La empresa mantendrá los "detalles de apuestas" en caso de disputas.</p>

                    <p>En caso de error del sistema o error no intencional del empleado, la empresa se reserva el derecho de corregir los resultados y publicarlos en la barra de información del sitio.</p>

                    <p>Los miembros deben asegurarse de que su usuario y contraseña sean correctos y deben cambiarlos al menos una vez al mes. Si sospecha un acceso no autorizado, notifíquelo inmediatamente.</p>

                    <p>Antes de apostar, revise sus límites. Para cualquier consulta, contacte a su representante.</p>

                    <p>En caso de un evento inesperado, como pérdida de datos por una caída de Internet, la empresa anunciará la causa y la solución.</p>

                    <p>Servicio disponible 24/7.</p>

                    <h4>Sistema de seguridad</h4>
                    <p>La información proporcionada al abrir la cuenta será tratada con la máxima confidencialidad y no será compartida con terceros. Solo será usada para los fines previstos.</p>

                    <p>La compañía utiliza los métodos más efectivos para proteger sus datos. Para cualquier consulta, contacte a nuestro servicio al cliente.</p>

                    <p>La empresa está encantada de servirle.</p>
                '
            ],


            [
                'key' => 'TERMS_CONDITIONS',
                'value' => 'ข้อกำหนดและเงื่อนไข',
                'lang' => 'th',
                'data' => '
                    <p>ยินดีต้อนรับสู่ลอตเตอรีออนไลน์ เพื่อให้คุณทราบสิทธิประโยชน์ของสมาชิก กรุณาอ่านข้อตกลงอย่างละเอียดก่อนสมัครสมาชิกและใช้งาน <strong>wls.infinitilotto.com</strong> สมาชิกถือว่าได้อ่านและยอมรับ "ข้อกำหนดและเงื่อนไขการให้บริการเว็บไซต์"</p>

                    <h4>การดูแลและช่วยเหลือการเดิมพันออนไลน์</h4>
                    <p>หากสมาชิกออกจากเว็บไซต์ระหว่างการเดิมพัน บัญชีของคุณจะไม่ส่งผลต่อผลลัพธ์ของการเดิมพัน 
                    ไม่ต้องกังวล หากสมาชิกออกจากเว็บไซต์ระหว่างการเดิมพัน สมาชิกจะถูกออกจากระบบชั่วคราว และสามารถเข้าสู่ระบบใหม่ได้ตามปกติ</p>

                    <h4>การปกป้อง</h4>
                    <p>wls.infinitilotto.com ได้จัดเตรียมระบบที่มีประสิทธิภาพ รวดเร็ว และบริการลูกค้าที่เป็นมิตรตลอด 24 ชั่วโมง ทุกวันไม่มีวันหยุด และรับประกันว่าจะเก็บข้อมูลส่วนบุคคลของคุณเป็นความลับ</p>

                    <h4>เงื่อนไขการเดิมพัน</h4>
                    <p>เพื่อหลีกเลี่ยงปัญหาในการใช้งานเว็บไซต์ กรุณาอ่านกฎของบริษัทอย่างรอบคอบ เมื่อเข้าสู่หน้าการเดิมพัน บริษัทจะถือว่าคุณยอมรับเงื่อนไขแล้ว</p>

                    <p>การเดิมพันต้องอยู่ใน "ระยะเวลาที่กำหนด" หากถูกยกเลิกหรือตัดสิทธิ์ก่อนเริ่มเล่น การเดิมพันนั้นจะถือเป็น "โมฆะ" และเครดิตจะถูกคืนให้สมาชิก</p>

                    <p>สมาชิกมีหน้าที่ตรวจสอบผลลัพธ์ บริษัทจะเก็บรักษา "รายละเอียดการเดิมพัน" ไว้สำหรับกรณีมีข้อสงสัย</p>

                    <p>หากเกิดข้อผิดพลาดของระบบหรือความผิดพลาดโดยไม่ได้ตั้งใจ บริษัทขอสงวนสิทธิ์แก้ไขผลลัพธ์ และประกาศไว้บนเว็บไซต์โดยไม่แจ้งสมาชิกเป็นการส่วนตัว</p>

                    <p>สมาชิกต้องตรวจสอบชื่อผู้ใช้และรหัสผ่านให้ถูกต้อง และควรเปลี่ยนรหัสผ่านอย่างน้อยเดือนละครั้ง หากสงสัยว่ามีผู้เข้าถึงโดยไม่ได้รับอนุญาต กรุณาแจ้งเจ้าหน้าที่ทันที</p>

                    <p>ก่อนเริ่มเดิมพันควรตรวจสอบวงเงินของคุณ หากมีข้อสงสัยเกี่ยวกับวงเงิน กรุณาแจ้งเจ้าหน้าที่ทันที</p>

                    <p>หากเกิดเหตุการณ์ไม่คาดคิด เช่น การสูญหายของข้อมูลเนื่องจากอินเทอร์เน็ตขัดข้อง บริษัทจะแจ้งสาเหตุและแนวทางแก้ไข</p>

                    <p>เปิดให้บริการตลอด 24 ชั่วโมง ไม่มีวันหยุด</p>

                    <h4>ระบบความปลอดภัย</h4>
                    <p>ข้อมูลส่วนบุคคลที่ให้ไว้ตอนเปิดบัญชีจะถูกเก็บเป็นความลับสูงสุด และจะไม่ถูกเปิดเผยแก่บุคคลที่สาม ใช้เพื่อวัตถุประสงค์ตามที่กำหนดเท่านั้น</p>

                    <p>บริษัทใช้วิธีการที่มีประสิทธิภาพที่สุดเพื่อปกป้องข้อมูลของคุณ หากมีข้อสงสัย โปรดติดต่อฝ่ายบริการลูกค้าได้ตลอดเวลา</p>

                    <p>บริษัทมีความยินดีเป็นอย่างยิ่งที่ได้ให้บริการคุณ</p>
                '
            ],

        ];

        foreach ($links as $link) {
            LinksContent::Create([
                'key' => $link['key'],
                'value' => $link['value'],
                'lang' => $link['lang'],
                'data' => $link['data']
            ]);
        }
    }
}
