<!DOCTYPE html>
<html>
<head>
    <title>COMPLETE CARE HOME WARRANTY</title>
    <style type="text/css">
        /*.prevImage {
            margin: 10px;
            display: block;
        }*/
        table{
            width: 100%;
        }
        ol{
            margin: 0;
        }
    </style>
</head>
<body>

    <table border="0" cellpadding="1" cellspacing="1" style="width:800px; margin: 0 auto;">
        <tbody>
            <tr>
                <td style="text-align: center;">
                    <br>
                    <br>
                    <br>
                    <img src="<?php echo base_url(); ?>assets/pdf-logo.png" alt="PDF Logo" style="width: 395px;">
                    <br>
                    <br>
                    <br>
                    <p style="margin-top: 5px;font-size: 21px;font-weight: 600;">
                        <u>TERMS OF SERVICE AGREEMENT</u>
                    </p>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <strong style="margin: 10px 0 0;"><u>Contract Number:</u></strong>  <?php echo $latest_policy['policy_num']; ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Plan Selected:</u></strong>  <?php echo $plan_value; ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Coverage:</u></strong>  <?php echo $plan_coverage; ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Optional Coverage:</u></strong>  <?php if (empty($extra_coverage)){ ?> None <?php }else{ echo $extra_coverage; } ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Contract Holder Name:</u></strong>  <?php echo $details['first_name'].' '.$details['last_name']; ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Covered Property:</u></strong>  <?php echo $details['street_address'].' '.$details['city'].' '.$details['state'].' '.$details['zip_code']; ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Property Type:</u></strong>  <?php echo $property_type; ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Term:</u></strong>  <?php echo date('m/d/Y', strtotime($latest_policy['plan_start'])); ?> - <?php echo date('m/d/Y', strtotime($latest_policy['plan_end'])); ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Rate:</u></strong>  <?php echo '$'.$latest_policy['net_total']; ?>
                    <br>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Service Call Fee:</u></strong>  <?php echo $scf_value; ?>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    *Coverage is subject to the limitations and exclusions set forth in the Home Service
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size: 14px;">Agreement. </span><strong style="margin: 10px 0 0;"><u> COMPLETE CARE HOME WARRANTY SERVICE CONTRACT </u></strong>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    Throughout this Contract the words "We," "Us," "Our," and "Obligor," refer to Complete Care Home Warranty, LLC, also referred to as Complete Care Home Warranty. "You," "Your," and "Customer" refer to the person contracting for services covered by this Contract and whose name(s) appear on the Cover Page. Certain items and events are not covered by this Contract. Please read the Contract carefully. Coverage includes only certain mechanical failures of the specific items listed as covered on the Cover Page and excludes all other failures and/or items. The Cover Page is attached to and made a part of this Contract. "Contract" refers to this agreement You have purchased and includes the Cover Page. "Purchase Price" refers to the amount you paid for coverage under this Contract. "Breakdown" refers to when a covered item becomes inoperable due to mechanical failure caused by normal wear and tear. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong style="margin: 10px 0 0;"><u>BASIS FOR COVERAGE </u></strong>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    During the term of this Contract, We agree to pay the covered costs to repair or replace the items listed as covered on Your Cover Page if any such items become inoperable due to mechanical failure caused by normal wear and tear. Determination of coverage including the operational condition as of the Contract effective date for any claim will be made solely by Us considering, but not limited to, Our independent contractor's diagnosis, hereinafter referred to as the "Service Contractor." This Contract does not cover any known or unknown pre-existing conditions. It is understood that WE ARE NOT A SERVICE CONTRACTOR and We are not Ourselves undertaking to repair or replace any such systems or components. This Contract covers single-family homes, new construction homes, condominiums, townhomes, and mobile homes under 5,000 square feet, unless an alternative dwelling type (i.e. above 5,000 square feet or multi-unit home) is applied and appropriate fees are paid. This Contract will not cover systems or appliances within (a) commercial properties; (b) residential properties used for business purposes including, but not limited to, dwellings used for rest homes, day care centers, schools and/or professional offices; (c) common areas of condominiums, multi-family houses and/or cooperatives; (d) vacant properties; or (e) foreclosed/short sold properties. Coverage applies to the systems and components mentioned as "covered" in accordance with the terms and conditions of this Contract so long as such systems and components: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;">Become inoperable due to normal wear and tear; </li>
                        <li style="margin-bottom: 2px;">Are in place and in proper working order on the effective date of this Contract; and </li>
                        <li style="margin-bottom: 2px;">Are located inside the confines of the main foundation of the home or attached or detached garage, with the exception of the air conditioner, exterior pool/spa, septic system, and well pump. </li>
                    </ol>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong style="margin: 10px 0 0;"><u>TERM</u></strong>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    Coverage starts 30 days after acceptance of application by Us and receipt of applicable Contract fees and continues for 365 days from that date. We reserve the right to waive the 30-day waiting period so long as You provide proof of coverage from another home service provider showing no lapse in coverage. Waiving of the 30-day waiting period is at Our sole discretion. Contract fees shall be defined as any amounts You owe Us including the initial amount You are required to pay us for purchase of this Contract and any fees for service calls.  
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong style="margin: 10px 0 0;"><u>REQUESTING SERVICE</u></strong>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    We must be notified as soon as the malfunction is discovered and prior to expiration of the Contract. You can request service by calling 223-747-4110. We will accept service requests 24 hours a day, 7 days a week. We will not provide service until all past due Service Call Fees and Contract fees are made current. 
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;">Upon request for service under normal circumstances, We will contact a Service Contractor within forty-eight (48) after You request service. The Service Contractor will contact You to schedule a mutually convenient appointment during normal business hours. We will determine what repairs constitute an emergency and will make reasonable efforts to expedite emergency service. We will accept Your request to expedite scheduling of non-emergency service only when a Service Contractor is available. If the Service Contractor agrees to expedite scheduling of a non-emergency service request, You may be required to pay an additional fee.</li>
                        <li style="margin-bottom: 2px;">We have the sole and absolute right to select the Service Contractor to perform the service. We will not reimburse You for services performed without Our prior approval. </li>
                        <li style="margin-bottom: 2px;">We reserve the right to obtain a second opinion at Our expense. In the event that We inform You the malfunction is not covered under this Contract, You have the right to request a second opinion concerning the cause of the malfunction. You must ask Us for a second opinion from another Service Contractor within seven (7) days from Us informing You the malfunction is not covered. In the event that the outcome of the second opinion is different than the first opinion, then We may, in Our discretion, decide whether to accept coverage under this Contract. If You request a second opinion, You will be responsible for the payment of an additional Service Call Fee only if the outcome of the second opinion is the same as the initial opinion. </li>
                        <li style="margin-bottom: 2px;">In the event We authorize or request You to contact an independent service contractor to perform a covered service, We will provide reimbursement for an authorized amount of the cost You incur for the repair or replacement services. Acceptable proof of the repair and Your actual itemized costs must be provided to and approved by Us before any reimbursement will be paid. We are not responsible for expenses You incur without Our express consent. We will not reimburse You for any costs associated with unauthorized repairs or work performed by unauthorized contractors.</li>
                        <li style="margin-bottom: 2px;">If service work performed under this Contract should fail, then We will make the necessary repairs without an additional Service Call Fee for a period of 90 days on parts and 30 days on labor. </li>
                    </ol>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong style="margin: 10px 0 0;"><u>SERVICE CALL FEE </u></strong>
                    <br>
                    <br>
                    Note: The amount of Your Service Call Fee is listed on Your Cover Page. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;">You are required to pay a Service Call Fee for each trade service request You submit to Us. </li>
                        <li style="margin-bottom: 2px;"> The Service Call Fee applies to each call dispatched and scheduled including, but not limited to, those calls where coverage is approved or denied, included or excluded, covered or not covered. The Service Call Fee also applies in the event You fail to be present at a scheduled time, or in the event You cancel a service request at the time a Service Contractor is in route to Your home or at Your home. Failure to pay the Service Call Fee will result in suspension or cancellation of this Contract until such time as the proper Service Call Fee is paid. At that time, the Contract may be reinstated; however, the Contract period will not be extended. </li>
                        <li style="margin-bottom: 2px;">If a particular repair or replacement fails within 30 days, We will send a Service Contractor to repair the failure and You will not be charged an additional Service Call Fee. </li>
                        
                    </ol>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong style="margin: 10px 0 0;"><u>COVERAGE </u></strong>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    Coverage is dependent on plan you selected. Please refer to your Agreement Coverage Summary page. Coverage is for no more than one (1) unit, system, or appliance, unless additional fees are paid or specified otherwise. If no additional fees are paid, covered unit, system, or appliance is at our sole discretion. Certain limitations of liability apply to covered systems and appliances. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                   <span style="font-size: 15px;"><strong><u>Air Conditioner</u></strong>- NOTE: Not Exceeding 5 (five)</span> ton capacity and designed for residential use. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">COVERED:</span> Mechanical parts and components of two (2) ducted electric central air conditioning systems. All components and parts, for units below 14 SEER and/or R-22 equipment, and when we are unable to facilitate repair/replacement of failed covered equipment at the current SEER rating, repair/replacement will be performed with 14 SEER equipment and/or 7.7 HSPF or higher compliant, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Filters; filter driers; condenser casings; registers and grills; water towers; humidifiers; chillers; electronic air cleaners; window units; non-ducted wall units; mini-split wall units; gas air conditioning systems; water evaporative coolers; swamp coolers; condensate pumps; thermal expansion valves; all exterior condensing, cooling and pump pads; disconnect boxes; roof mounts, jacks, stands or supports; cost for crane rentals; electronic, computerized, and manual systems management and zone controllers; commercial grade equipment; refrigerant conversion; leak detections; water leaks; drain line stoppages or drain pans; maintenance; rusted and/or corroded coils; component short to ground; noise without a related mechanical failure; improperly sized units; air conditioning with mismatched condensing unit and evaporative coil per manufacturer specifications; improper use of metering devices (i.e. thermal expansion valves). We are not responsible for the costs associated with matching dimensions, brand or color made. We will not pay for any modifications or upgrades necessitated by the repair of existing equipment or the installation of new equipment.  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>Heating System: </u></strong> NOTE: </span>  Coverage available on units up to a 5-ton capacity and for residential use only.
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">COVERED:</span> Mechanical parts and components of two (2) systems, either hot water and steam heating system or centrally ducted forced air gas/electric/oil heating system or electric baseboard units, if providing the primary source of heat in dwelling, as follows: accessible ductwork from covered heating unit to point of attachment to register/grill; blower fan motors; burners; controls; fan blades; heat/cool thermostats (programmable and electronic set back units will be replaced only with standard units); heat exchangers; heating elements; ignitor and pilot assemblies; internal system controls; wiring; and relays; motors (excludes dampers); and switches. Electric baseboard units are covered if they are the primary source of heating for the property.  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Chimneys, flues, and liners; cleaning and re-lighting of pilots; concrete encased or inaccessible ductwork; concrete encased or inaccessible steam or radiant heating coils or lines; conditions of water flow restriction due to scale, rust, minerals and other deposits; cracked heat exchangers; rusted and/or 
                    corroded heat exchangers; maintenance and cleaning; calcium build-up; evaporator coil pan; primary or secondary drain pans; fossil and dual fuel control systems and other energy management systems and controls; dampers; asbestos insulated ductwork or piping; electric baseboard heat unless primary heating system in home; filters (including electronic/electrostatic and de-ionizing filter systems); fireplaces and their respective components and gas lines; free-standing or portable heating units; heat lamps; pellet stoves; fuel storage tanks, lines, and filters; gas log systems, including gas feed lines; valves; key valves; oil filters, nozzles, or strainers; humidifiers; inaccessible water/steam lines leading to or from system; backflow preventers; individual space heaters; panels and/or cabinetry; radiant heating systems built into walls, floors or ceilings; registers and grills; secondary units; solar heating devices and components; maintenance; noise without a related mechanical failure; improperly sized heating systems; mismatched systems; and structural components. 
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>Plumbing System and Stoppage: </u></strong> NOTE: </span>   Mainline stoppages are only covered if there is an accessible ground level clean out. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">COVERED:</span> Leaks and breaks of water, drain, gas, waste or vent lines, except if caused by freezing or roots; toilet tanks, bowls and mechanisms within the toilet tank (replaced with builder’s grade as necessary); toilet wax ring seals; valves for shower, tub, and diverter angle stops, rinses and gate valves; permanently installed interior sump pumps; built-in bathtub whirlpool motor and pump assemblies; stoppages and/or clogs in drain and sewer lines up to 100 feet from access point. Repair and finish of any walls or ceilings where it is necessary to break through to effect repair is only covered to the following extent: repair of walls or ceilings to rough finish up to $500 per claim. Rough finish is defined to include hanging of drywall, patching of drywall, stucco, and lath. Repair to rough finish does not include supplies or labor for paint, sanding, wall texture, wallpaper and/or tile work.
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   All plumbing in or under the ground, foundation or slab; all piping and plumbing outside of the perimeter of the foundation; any piping or plumbing in a detached structure; stoppage of concrete encased lines; any fees for locating, accessing or installing cleanouts; removal of water closets/toilets in order to clear stoppages, any fees for photo/video equipment, hydro-jetting equipment; jet or steam clearing; chemicals; stoppages caused by root invasion; stoppages caused by foreign objects, such as but not limited to, sanitary wipes, toys, bottle caps, etc.; bath tubs; toilet lids and seats; sinks; cracked porcelain; basket and strainers; pop-up assemblies; tub waste overflow; glass; bidets; electronic toilets/bidets; caulking or grout; color or purity of the water in the system; concrete encased plumbing; conditions of insufficient or excessive water pressure; conditions of water flow restriction due to scale, rust, sediment, calcium buildup and other deposits; hose bibs; faucets and fixtures; faucet and fixture cartridges; water softeners; freeze damage; holding and pressure tanks; jet pumps; laundry tubs; lawn sprinkler systems; saunas and/or steam systems; polybutylene or quest piping; galvanized drain lines; drum traps; flange; repair and finish of any floors where it is necessary to break through to effect repairs; septic tanks and systems in or outside of the home; sewage ejector pumps; sewer and water laterals; shower enclosures and base pans. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>ELECTRICAL SYSTEM: </u></strong> COVERED: </span>   All components and parts including built-in bathroom exhaust fans, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Attic exhaust fans; direct current (DC) wiring and systems; exterior wiring and components (except main panels mounted to exterior wall); any wiring or components servicing a detached structure; fire, carbon monoxide alarm and/or detection systems; batteries; intercom or speaker systems; doorbells; multimedia systems; lighting fixtures; load control devices; low voltage systems including wiring and relays; service entrance cables; telephone systems; telephone wiring; cable wiring; alarm and/or security systems and wiring; timers; touch pad assemblies; transmitters and remotes; utility meter base pans; solar power systems and panels; all solar components and parts; energy management systems; commercial grade equipment; auxiliary or sub-panels; bus bars; broken and/or severed wires; rerunning of new wiring for broken wires; wire tracing; central vacuum systems. Failures and conditions caused by inadequate wiring capacity, inadequate size breakers, circuit overload, power failure/shortage or surge, and corrosion are not covered. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement. 
                    <br>
                    <br>
                </td>
            </tr>
             <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>WATER HEATER: </u></strong> COVERED: </span>    All components and parts for gas and/or electric hot water heaters, including circulating pumps, except: 
  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>    Auxiliary and secondary holding/storage tanks; main, holding or storage tanks; expansion tanks; base pans; drain pans and drain lines; line restrictions; pressure reducing valve; mineral and/or calcium build-up; sediment build up; rust and corrosion; combustion shutdown; color or purity of water; flues; vent pipes/lines; insulation and insulation blankets; heat recovery units;; low boy and/or squat water heaters; tankless hot water heaters; solar water heaters including all solar components and parts; any noise without a related mechanical failure; racks; straps; timers; energy management systems; commercial grade equipment and units exceeding 75 gallons. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement.
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>REFRIGERATOR: </u></strong> NOTE: </span>    refrigerator must be located in the kitchen. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">COVERED:</span> All components and parts, including integral freezer unit, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Racks; shelves; glass; lighting; handles; doors, door seals, hinges, and gaskets; Freon; disposal and recapture of Freon; beverage dispensers and their respective equipment; water lines and valve to ice maker; line restrictions; leaks of any kind; ice maker; ice crushers; maintenance; interior thermal shells; freezers which are not an integral part of the refrigerator; wine chillers or mini refrigerators; food spoilage; noise without a related mechanical failure; multi-media centers and internet connection components.
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>CLOTHES WASHER: </u></strong> COVERED: </span>     All components and parts, except
  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Filter Screens; knobs and dials; soap dispensers; removable mini tubs; doors, door seals and hinges; glass; leveling and balancing; damage to clothing; commercial units; noise without a related mechanical failure; conditions of water flow restrictions due to scale, rust, minerals and other deposits. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>CLOTHES DRYER: </u></strong> COVERED: </span>  All components and parts, except:
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Venting; lint screens; knobs and dials; doors, door seals, and hinges; glass; leveling and balancing; noise without a related mechanical failure; damage to clothing; conditions of air flow restriction due to a lack of maintenance and/or clogged lint screens. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>OVEN/RANGE/STOVE/COOKTOP: </u></strong> COVERED: </span>   All mechanical components and parts, except:
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Doors; door seals; hinges; handles; glass; knobs; lighting; clocks (unless they affect the cooking function of the unit); meat probe assemblies, rotisseries; racks and trays; downdrafts; range exhaust hoods; independent telescoping range exhaust; exhaust fan not solely for venting range/cooktop fumes; filters and screens; venting; sensi-heat burners will only be replaced with standard burners; drip pans; self-cleaning mechanisms including door latches; commercial units. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>BUILT IN MICROWAVE: </u></strong> COVERED: </span>   All mechanical components and parts, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Doors; hinges; handles; glass; knobs; lights; clocks (unless they affect the cooking function of the unit); meat probe assemblies, rotisseries; racks and trays; interior linings; arcing; portable or counter top units. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>DISHWASHER: </u></strong> COVERED: </span>   All mechanical components and parts, except:
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Doors; door seals; hinges; handles; glass; knobs; racks, trays, or baskets; rollers; damage caused by broken glass; noise without a related mechanical failure; maintenance and cleaning; commercial units; or portable units. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>GARBAGE DISPOSAL: </u></strong> COVERED: </span>   All components and parts, including entire unit, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Failures and/or jams caused by bones, eggshells, glass, or foreign objects other than food.  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>DUCTWORK: </u></strong> COVERED: </span>    Duct from heating and air conditioning unit to point of attachment at registers or grills, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Registers and grills; insulation; insulated ductwork; asbestos; vents, flues and breaching; ductwork exposed to outside elements; improperly sized ductwork; separation due to settlement and/or lack of support; damper motors; diagnostic testing of, or locating leaks to ductwork, including but not limited to, as required by any federal, state or local law, ordinance or regulation, or when required due to the installation or replacement of system equipment. We will only provide access to ductwork through unobstructed walls, ceilings, or floors, and will return the access opening to Rough Finish condition. With respect to concrete covered, embedded, encased, or otherwise inaccessible ductwork, We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement. "Rough Finish" is defined to include hanging of drywall, patching of drywall, stucco, and lath. Repair to Rough Finish condition does not include supplies or labor for paint, sanding, wall texture, wallpaper, and/or tile work. We shall not be responsible for payment of the cost to remove and replace any built-in appliances, cabinets, floor coverings or other obstructions impeding access to walls, ceilings, and/or floors. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>GARAGE DOOR OPENER: </u></strong> Note: </span>     Coverage is for no more than one (1) unit, system, or appliance, unless additional fees are paid.
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"> COVERED: </span>  All components and parts, except:
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED: </span>   Garage doors; hinges; springs; sensors; chains; travelers; door track assemblies; rollers; lights; keypads; wall buttons; or remote receiving and/or transmitting devices. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>CEILING AND EXHAUST FANS: </u></strong> Note: </span>  : Coverage is for no more than two (2) units, systems, or appliances, unless additional fees are paid. Builder’s standard equipment is used when replacement is necessary.
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"> COVERED: </span> Motors; switches; controls; bearings, except:
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED: </span> Kitchen exhaust fans; range exhaust fans; fan blades; belts; shutters; filters; lighting. We will pay no more than $300 per contract term for access, diagnosis, repair and/or replacement. 
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <strong><u>OPTIONAL COVERAGE</u></strong>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    Optional Coverage requires additional payment per item, system, or appliance. You may purchase any Optional Coverage for up to 30 days after commencement of Coverage. However, Coverage shall not commence until receipt of payment by us and such Coverage shall expire upon expiration of Coverage period in section II. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>POOL/SPA EQUIPMENT: </u></strong> COVERED: </span>     Above ground components and parts of the pumping, and filtration system including pool sweep motor and pump; pump motor; blower motor and timer; filter; filter timer; gaskets; timer; valves, limited to back flush, actuator, check, and 2 and 3-way valves; relays and switches; above ground plumbing pipes and wiring, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Portable or above ground pools or spas; access to pool and spa equipment; lights; liners and tile; jets; ornamental fountains, waterfalls, and their pumping systems; auxiliary pumps; pool cover and related equipment; fill line and fill valves; built-in or detachable cleaning equipment including, without limitation, pool sweeps, pop-up heads, turbo valves, skimmers, chlorinators, and ionizers; fuel storage tanks; disposable filtration mediums; heat pump; heaters; control panels; control boards; multi-media centers; dehumidifiers; salt water generators and components; salt water systems; cracked or corroded filter casings; grids; cartridges; maintenance; structural defects; or solar equipment and components. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement.  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>LIMITED ROOF LEAK: </u></strong> Note: </span>   Coverage applies to single family homes only. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"> COVERED: </span> Repair of shake and composition roof leaks over the occupied living area. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED: </span>  Leaks related to patios; porches; decks; metal roofs; foam roofs; shingles; cemwood shakes; cracked and/or missing material; tiles; tar and gravel; flat or built-up roofs; structural leaks; asphalt; gutters; downspouts; skylights; flashing; patio covers; solar components; attic vents; roof jacks; satellite components; antennae; chimney components; partial roof replacement; preventative maintenance. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement. 
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>CENTRAL VACUUM: </u></strong> COVERED: </span>   All mechanical components and parts, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Ductwork; piping; nozzles; hoses; blockages; or accessories.   
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>SUMP PUMP: </u></strong> COVERED: </span>   Mechanical parts and components of permanently installed sump pump for ground water, within the foundation of the home or attached garage, except:  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Any unit located outside the covered property and/or within crawl spaces; back-up power assemblies; portable or non-hard piped installed units; sewerage ejector pumps; backflow preventers; check valves; piping modifications for new installs. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>WELL PUMP: </u></strong> COVERED: </span>   All components and parts of well pump utilized as a main source of water to the home. 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   Above or underground piping, cable or electrical lines leading to or from the well pump, including those that are located within the well casing; holding or storage tanks; digging; locating pump; pump retrieval; redrilling of wells; well casings; pressure tanks; pressure switches and gauges; check valve; relief valve; drop pipe; piping or electrical lines leading to or connecting pressure tank and main dwelling including wiring from control box to the pump; booster pumps; or well pump and all well pump components for geothermal and/or water source heat pumps. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>SEPTIC SYSTEM: </u></strong> COVERED: </span>  Sewage ejector pump for septic system only; jet pump; aerobic pump. Clearing of stoppages within the connecting waste line (leading from the house to the primary septic tank) which are attributable to normal wear and tear and can be accessed through an existing clean out without excavation.  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Broken or collapsed sewer lines; tile fields; leach beds; leach lines; lateral lines; tanks; insufficient capacity; seepage pits; or cesspools and sewage ejector pumps not associated with the septic system. We do not cover the cost associated with locating or gaining access to the septic tank or sewer hook-ups nor do We cover the cost of installing cleanouts or hook ups if they do not already exist; disposal of waste; pumping; or chemical treatments of the septic tank or sewer lines, stoppages caused by root invasion and/or stoppages caused by foreign objects such as, but not limited to, toys and bottle caps. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>SEPTIC TANK PUMPING: </u></strong> COVERED: </span>   The septic tank will be pumped once during the Agreement term if the stoppage is due to septic back up only. Coverage applies to main line stoppages and/or clogs and must have existing access to clean out. Coverage can only become effective if a septic certification was completed within 90 days prior to close of sale. We reserve the right to request a copy of the certification prior to service dispatch.  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>   We do not cover the cost associated with locating or gaining access to the septic tank or sewer hook-ups nor do we cover the cost of installing cleanouts or hook ups if they do not already exist; disposal of waste; chemical treatments of the septic tank or sewer lines; leach beds; leach lines; lateral lines; tanks; cesspools; mechanical pumps and/or systems. We will pay no more than $200 per contract term for access, diagnosis, repair; and pumping.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>SECOND REFRIGERATOR: </u></strong> COVERED: </span>  All components and parts, including integral freezer unit, except: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span> Racks; shelves; glass; lighting; handles; doors, door seals, hinges, and gaskets; Freon; disposal and recapture of Freon; ice makers, ice crushers, beverage dispensers and their respective equipment; water lines and valve to ice maker; line restrictions; leaks of any kind; maintenance; interior thermal shells; freezers which are not an integral part of the refrigerator; wine chillers or mini refrigerators; food spoilage; noise without a related mechanical failure; or multi-media centers and internet connection components.   
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>STAND ALONE FREEZER: </u></strong> COVERED: </span>   All components and parts, except:  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>    Racks; shelves; glass; lighting; handles; doors, door seals, hinges, and gaskets; Freon; disposal and recapture of Freon; ice makers, ice crushers; water lines and valve to ice maker; line restrictions; leaks of any kind; maintenance; interior thermal shells; food spoilage; noise without a related mechanical failure; or multi-media centers and internet connection components.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>WATER SOFTENER: </u></strong> COVERED: </span>   Mechanical parts and components of basic single water softener unit, including central head assembly; multi-level/twin softeners; piping to and from unit(s) and system tanks.  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>    Any and all treatment, purification, odor control, iron filtration components and systems; discharge drywells; inadequate pressure; failure due to excessive water pressure or freeze damage; failures due to mineral and/or sediment; resin bed replacement and salt; leased or rented units; softening agents. We will pay no more than $500 per contract term for access, diagnosis, repair and/or replacement.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>REFRIGERATOR ICE MAKER: </u></strong> COVERED: </span>   Mechanical components and parts related to the kitchen refrigerator ice maker only, except:  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>  Free standing ice makers; Freon; disposal and recapture of Freon; dispensers; ice crushers; water lines and valve to ice maker; line restrictions. We will pay no more than $200 per contract term for access, diagnosis, repair and/or replacement.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;"><strong><u>FREE STANDING ICE MAKER: </u></strong> COVERED: </span>  All mechanical components and parts, except:  
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    <span style="font-size: 15px;">NOT COVERED:</span>    Racks; shelves; glass; lighting; handles; doors, door seals, hinges, and gaskets; Freon; disposal and recapture of Freon, ice crushers; water lines and valve to ice maker; line restrictions; leaks of any kind; maintenance; interior thermal shells; noise without a related mechanical failure; leveling and balancing; commercial units. We will pay no more than $200 per contract term for access, diagnosis, repair and/or replacement.    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><u>GENERAL LIMITATIONS OF LIABILITY</u></strong> 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        
                        <li style="margin-bottom: 2px;">The following are not included during the contract term; (i) malfunction or improper operation due to rust or corrosion of all systems and appliances, (ii) collapsed ductwork, (iii) known or unknown pre-existing conditions, deficiencies and/or defects.</li>
                        
                        <li style="margin-bottom: 2px;">We are not responsible for the repair of any cosmetic defects or performance of routine maintenance. </li>
                        
                        <li style="margin-bottom: 2px;">At times it is necessary to open walls or ceilings to make repairs. The Service Contractor provided by Us will close the opening and return to a Rough Finish condition. "Rough Finish" is defined to include hanging of drywall, patching of drywall, stucco, and lath. Repair to Rough Finish condition does not include supplies or labor for paint, sanding, wall texture, wallpaper, and/or tile work. We are not responsible for restoration of any wall coverings, floor coverings, plaster, cabinets, counter tops, tiling, paint, or the like.</li>
                        
                        <li style="margin-bottom: 2px;">This Agreement covers only repairs and/or replacements due to mechanical failure attributable to ordinary wear and tear. Accordingly, the Agreement does not cover failures which may result from other causes, such as without limitation abuse; misuse and/or neglect; lack of maintenance; rust and/or corrosion; noise without a related mechanical failure; chemical or sedimentary build up; failures due to calcium build-up; lightning strikes; missing parts; animal, pet and/or pest damage; power failure; power surge; fire; casualty; water damage; acts of God; structural and/or property damage; flood; smoke; earthquake; freeze damage; accidents; war; acts of terrorism; nuclear explosion, reaction, radiation or radioactive contamination; insurrection; riots; vandalism; or intentional destruction of property. This Agreement does not cover mechanical failures resulting directly or indirectly from or caused by mold, mildew, mycotoxins, fungus, bacteria, virus, condensation, and/or wet or dry rot regardless of the source, origin, or location and any other cause or event contributing concurrently or in any sequence to the mechanical failure. We are not responsible for drywall or rough finish repairs on not covered claims.</li>
                        
                        <li style="margin-bottom: 2px;">This Contract shall not cover any item(s) if they are mismatched systems with components having incompatible capacity ratings; modified from the original manufacturer design or application; items determined to be defective by the Consumer Product Safety Commission or the manufacturer and for which either has issued, or issues, a warning or recall,<br>  or which is otherwise necessitated due to failure caused by the manufacturer's improper design, use of improper materials and/or formulas, manufacturing process or any other manufacturing defect; improperly installed; below the slab or basement floor of the home; or located outside the perimeter of the main foundation (i.e., outside the outer load bearing walls of the structure with the exception of central air conditioning unit, main electrical panel) unless specifically covered with Optional Coverage purchased for items outside the main perimeter.</li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover upgrading or making modifications to items due to, but not limited to, the following: capacity (over or undersized); dimensional or design change; conditions of insufficient or excessive water pressure; conditions of inadequate wiring capacity; circuit overload; power failure and/or surge; failure to meet building code(s); zoning requirements; utility regulations; or failure to comply with local, state, or federal laws or regulations. </li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover any costs associated with construction, carpentry, or other modifications made necessary by the repair or replacement of existing equipment or installing different equipment. This Contract does not cover any costs associated with any upgrades or modifications to comply with federal, state, and/or local law, code, regulation, or ordinance. All such costs are Your responsibility. </li>
                        
                        <li style="margin-bottom: 2px;">SEER (Seasonal Energy Efficiency Ratio) operational compatibility: If we elect to replace an air conditioning condenser or heat pump unit, and it becomes necessary to make a mechanical modification to the evaporator coil in order to provide operational compatibility, we agree to pay the covered costs for one (1) of the following, determination is at our sole discretion, only: expansion metering device, or coil, or air handler. This Agreement does not cover any costs associated with modifications or upgrades required to match efficiency value, rating or ratio. </li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover fees associated with the removal and/or disposal of old systems, appliances, or components; or any fees or costs associated with Freon reclamation. </li>
                        
                        <li style="margin-bottom: 2px;">This Agreement does not cover fees associated with the removal and/or disposal of hazardous or toxic material or asbestos. </li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover repair or replacement of systems, appliances, or components classified by the manufacturer as commercial-grade. </li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover (i) fees associated with the use of cranes or other lifting equipment required to service any item or system; (ii) excavation or other charges associated with gaining access to a well pump; (iii) electronic computerized energy management systems or devices, or lighting and/or appliance management systems; or (iv) solar systems and solar components</li>
                        
                        <li style="margin-bottom: 2px;">This Agreement does not cover ductwork with the sole exception of ductwork that is exposed and readily accessible to service a mechanical failure of a covered air conditioning or heating system or item. This Agreement does not cover: asbestos insulated ductwork; concrete encased or inaccessible ductwork; crushed/collapsed ductwork; ductwork damaged by moisture, water, pests and/or animals; insulation; registers, grills and dampers; underground ductwork. Inaccessible ductwork refers to ductwork that is used in central heating and/or air conditioning systems that is not exposed and cannot readily be accessed for replacement or repair due to design and installation obstacles such as, but not limited to, permanent partitions, chimneys, etc., and ductwork embedded in floors, walls or ceilings. </li>
                        
                        <li style="margin-bottom: 2px;">This Agreement does not cover any costs incurred to gain and/or close access to a covered item, system, appliance or component in situations where there is not adequate capacity or space for serviceability caused by, but not limited to, walls, floors, ceilings, toilets, sinks, permanently installed fixtures, cabinets, snow/ice covered areas, flooded areas, or personal property. In the event it is necessary to open walls, floors, or ceilings, or to move such fixtures, cabinets, or personal property to perform a diagnosis or service, we are not responsible for restoring such openings, items, or property. This Agreement does not cover any costs associated with equipment to gain access or permit serviceability such as but not limited to scaffolding.</li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover delays or failures to provide service caused by, or related to, any of the exclusions listed herein; shortages of labor and/or materials; or any other cause beyond Our reasonable control. This Contract does not cover additional charges to access or transport materials, supplies, or independent Service Contractors to the covered property due to lack of or inhibited serviceability such as, but not limited to, tolls, required use of ferries or barges and/or remote locations.</li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover any incidental, consequential, special, and/or punitive damages, and You agree to waive any and all claims for such damages arising from, resulting from and/or related to the failure of any item or system including, but not limited to, food spoilage, loss of income, additional living expenses, and/or any loss, damage, cost, or expense directly or indirectly arising out of or resulting from, or in any manner related to, mold, mildew, mycotoxins, fungus, bacteria, viruses, condensation, wet or dry rot and/or other property damage.</li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover repairs or replacements of any item covered by other insurance, warranties, or guarantees including, but not limited to, manufacturer's, contractor's, builder's, distributor's, or home warranty. Our coverage is secondary to such insurance, warranties, or guarantees. </li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover any mechanical failure when the covered item or system has been repaired, modified, disabled or adjusted in any way which prevents Us or Our independent Service Contractor(s) from inspecting, diagnosing and/or repairing the mechanical failure. This Contract does not cover any mechanical failure to any covered item or system that has been improperly altered, repaired, installed, modified, or damaged in the course of remodeling or unauthorized repair. </li>
                        
                        <li style="margin-bottom: 2px;">This Contract does not cover performance of routine maintenance. You are responsible for performing all routine maintenance and cleaning for all covered items and systems as specified and recommended by the manufacturer. For example, You are responsible for providing maintenance and cleaning pursuant to manufacturers' specifications, such as periodic cleaning of heating and air conditioning systems, evaporator coils and condenser coils, as well as periodic filter replacement. We will not pay for repairs or failures that result from Your failure to perform normal or routine maintenance. </li>
                        
                        <li style="margin-bottom: 2px;">We are not liable for any damages that result from a Service Contractor’s service, delay in providing service or failure to provide service. We are not liable for any incidental, consequential, special, and/or punitive damages, whether caused by negligence or any other cause, and you agree to waive any and all claims for such damages, arising from, resulting from or related to any Service Contractor’s service, delay in providing service or failure to provide service, including, but not limited to, damages, resulting from delays in securing parts and/or labor, the failure of any equipment used by an independent Service Contractor, labor difficulties, and/or the negligent, tortuous and/or unlawful acts or omissions of any independent Service Contractor.</li>
                        
                        <li style="margin-bottom: 2px;">We have the sole right to determine whether a covered system or appliance will be repaired or replaced. We are responsible for installing replacement equipment of similar features, capacity, and efficiency, but not for matching dimensions, brand or color. We are not responsible for upgrades, components, parts, or equipment required due to the incompatibility of the existing equipment with the replacement system or appliance or component or part thereof or with new type of chemical or material utilized to run the replacement equipment including, but not limited to, differences in technology, refrigerant requirements, or efficiency as mandated by federal, state, or local governments. If parts are no longer available, we will offer a cash payment in the amount of the average cost between parts and labor of the covered repair. We reserve the right to locate parts at any time. We are not liable for replacement of entire systems or appliances due to obsolete, discontinued or unavailability of one or more integral parts. However, we will provide reimbursement for the costs of those parts determined by reasonable allowance for the fair value of like parts. We reserve the right to rebuild a part or component, or replace with a rebuilt part or component. </li>
                        
                        <li style="margin-bottom: 2px;">We reserve the right to offer cash back in lieu of repair or replacement in the amount of Our actual cost, which at times may be less than retail, to repair or replace any covered system, component, or appliance. In the event a covered system or appliance is deemed irreparable or it is not cost effective to repair, we may replace the system or appliance with a system or appliance of like capacity, the price of which shall not exceed the depreciated value of the system or appliance being replaced. CCHW is not responsible for installation. The cash settlement shall be in an amount not to exceed the depreciated value of the component, system, or appliance being replaced. In the event you elect to use the cash back funds to repair rather than replace your system or appliance, said system or appliance will no longer be covered by CCHW. </li>
                        
                        <li style="margin-bottom: 2px;">We are not liable for the repair or replacement of commercial grade equipment, systems, or appliances. We shall pay no more than $1,000 in aggregate for professional series or like appliances such as, but not limited to, brand names such as Sub Zero, Viking, Wolf, Bosch, JennAir, GE Monogram, Thermador, Miele, Fisher & Paykel, etc.</li>
                        
                        <li style="margin-bottom: 2px;">You agree that We are not liable for the negligence or other conduct of the Service Contractor, nor are We an insurer of the Service Contractor's performance. You also agree that We are not liable for consequential, incidental, indirect, secondary, or punitive damages. You expressly waive the right to all such damages. Your sole remedy under this Contract is recovery of the cost of the required repair or replacement, whichever is less. You agree that in no event will Our liability exceed $1500 per contract item for access, diagnosis, repair and/or replacement. </li>
                        
                        <li style="margin-bottom: 2px;">In the event You threaten to harm or actually harm the safety or well-being of: (i) Us; (ii) any employee of Ours; (iii) a Service Contractor; or (iv) any property of Ours or a Service Contractor, You will be in breach of this Contract. In the event You breach this or any other obligation under this Contract, We may refuse to provide service to You and may cancel this Contract. </li>
                    </ol>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td >
                    <strong><u>MULTIPLE UNITS AND INVESTMENT PROPERTIES </u></strong> 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;">If this Contract is for a 2-family, 3-family, or 4-family dwelling, then every unit within such dwelling must be covered by the Contract with applicable Optional Coverage for coverage to apply to shared systems and appliances.</li>
                        <li style="margin-bottom: 2px;">If this Contract is for a unit within a multiple unit of five (5) or more, then only items contained within the confines of each individual unit are covered. Shared systems and appliances are excluded.</li>
                        <li style="margin-bottom: 2px;">Except as otherwise provided in this section, shared systems and appliances are excluded.</li>
                        <li style="margin-bottom: 2px;">If this Contract is for a dwelling more than 5,000 square feet additional contract fees will apply. </li>
                    </ol>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><u>MEDIATION</u></strong> 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    In the event of a dispute over claims or coverage You agree to file a written informal claim with Us and allow Us twenty (20) calendar days to respond to the claim. You and We, agree to mediate in good faith before resorting to mandatory arbitration. All written claims should be mailed to Complete Care Home Warranty, LLC, Mediation Department, or emailed to info@completecarehomewarranty.com. 
                    <br>
                    <br>
                    Except where prohibited, if a dispute arises from or relates to this agreement or its breach, and if the dispute cannot be settled through direct discussions you agree that: 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;">Any and all disputes, claims and causes of action arising out of or connected with this agreement shall be resolved individually, without resort to any form of class action, and exclusively by the American Arbitration Association under its Commercial Mediation Rules. Controversies or claims shall be submitted to arbitration regardless of the theory under which they arise, including without limitation contract, tort, common law, statutory, or regulatory duties or liability. </li>
                        <li style="margin-bottom: 2px;">Any and all claims, judgments and awards shall be limited to actual out-of-pocket costs incurred to a maximum of $1,500 per claim, but in no event attorneys’ fees.</li>
                        <li style="margin-bottom: 2px;">Under no circumstances will you be permitted to obtain awards for, and you hereby waive all rights to claim, indirect, punitive, incidental and consequential damages and any other damages, other than for actual out-of-pocket expenses, and any and all rights to have damages multiplied or otherwise increased. All issues and questions concerning the construction, validity, interpretation and enforceability of this agreement, shall be governed by, and construed in accordance with, the laws of the State of Connecticut U.S.A without giving effect to any choice of law or conflict of law rules (whether of the State of New Jersey or any other jurisdiction), which would cause the application of the laws of any jurisdiction other than the State of New Jersey.</li>
                        <li style="margin-bottom: 2px;">Any claim must be brought in the parties individual capacity and not as a plaintiff or class member in any purported class, collective, representative, multiple plaintiff, or similar proceeding (“Class Action”). The parties expressly waive any ability to maintain any class action in any forum. The arbitrator shall not have authority to combine or aggregate similar claims or conduct any class action nor make an award to any person or entity not a party to the arbitration. <span style="font-size: 15px;">THE PARTIES UNDERSTAND THAT THEY WOULD HAVE HAD A RIGHT TO LITIGATE THROUGH A COURT, TO HAVE A JUDGE OR JURY DECIDE THEIR CASE AND TO BE PARTY TO A CLASS OR REPRESENTATIVE ACTION, HOWEVER, THEY UNDERSTAND AND CHOOSE TO HAVE ANY CLAIMS DECIDED INDIVIDUALLY, THROUGH ARBITRATION.</span> </li>
                    </ol>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><u>SEVERABILITY </u></strong> 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    If any provision of this agreement is found to be contrary to law by a court of competent jurisdiction, such provision shall be of no force or effect; but the remainder of the agreement shall continue in full force and effect.
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><u>RENEWALS AND TRANSFER OF CONTRACT</u></strong> 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;">We may, in Our sole discretion, elect to renew this Contract for a one-year contract term, unless otherwise approved by Us. In the event We elect to renew Your Contract, You will be notified of the terms within sixty (60) days of the expiration of Your Contract. Unless You notify Us prior to the expiration of Your Contract, Your Contract will be automatically renewed and You will be charged applicable Contract fees. </li>
                        <li style="margin-bottom: 2px;">If You select the monthly payment option and We elect to renew Your Contract, We will notify You of the applicable rate and terms of renewal during the tenth month of Your Contract. You will automatically be renewed for a monthly coverage period unless You notify Us in writing thirty (30) days prior to the expiration of Your Contract. Your first payment for the next contract term will be construed as authorization for month-to-month charges. </li>
                        <li style="margin-bottom: 2px;">If Your covered property is sold during the term of this Contract, You must notify Us of the change in ownership and submit the name of the new owner by calling 223-747-4110 in order to transfer Contract to the new owner. </li>
                        <li style="margin-bottom: 2px;">You may transfer this Contract at any time. There is no fee to transfer the Contract. </li>
                    </ol>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><u>CANCELLATION </u></strong> 
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;">This Agreement may be cancelled by Us for the following reasons: (i) nonpayment of Agreement fees or other breach of this Agreement by the customer; (ii) nonpayment of Trade Service Call Fee, as stated in section IV; (iii) fraud or misrepresentation by the customer and/or customer representative of facts material to the issuance of this Agreement; or (iv) a change in laws or regulations that has a material effect on the business of CCHW or Our ability to fulfill its obligations under this Agreement. </li>
                        <li style="margin-bottom: 2px;">You may cancel this Agreement within the first thirty (30) days of the order date for a full refund of the paid contract fees, less any service costs incurred by us. </li>
                        <li style="margin-bottom: 2px;">Mutual agreement of us and you. If this agreement is cancelled after thirty (30) days, you shall be entitled to a pro rata refund at the standard contract fee rate for the unexpired term, less a $50 administrative fee and any service costs incurred by us. If a refund calculation results in You owing Us payment for services provided, in states where permitted we may bill You for the greater of the net amount due to Us or the unpaid annual term contract fee. We will bill or you any balance owed to Us through the same mechanism as any previous installment billings, or We will direct bill You if such a mechanism is not available. </li>
                    </ol>
                    <br>
                    <br>
                </td>
            </tr>





            

            
            </tbody>
        </table>
    </body>
    </html>

            <!-- <tr>
                <td>
                    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">
                    
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <ol style="list-style-type:upper-alpha; font-size: 13px;">
                        <li style="margin-bottom: 2px;"></li>
                        <li style="margin-bottom: 2px;"></li>
                    </ol>
                    <br>
                    <br>
                </td>
            </tr> -->








