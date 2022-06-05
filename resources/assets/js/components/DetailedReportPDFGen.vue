<template>
    <div class="col-md-12">
        <button class="btn btn-link float-right" @click="exportPdf">
            <i class="far fa-file-pdf"></i>
           {{ $t('detailedReport.generate_pdf') }}
        </button>
        <button class="btn btn-link float-right" @click="exportDocx">
            <i class="far fa-file-word"></i>
            {{ $t('detailedReport.generate_docx') }}
        </button>
    </div>
</template>

<script>
    import { WidthType, BorderStyle, Document, Paragraph, Packer, TextRun } from "docx";
    import * as fs from "fs";
    import { saveAs } from 'file-saver';
    import jsPDF from 'jspdf'
    import autoTable from 'jspdf-autotable'
    import { log } from 'util';
    export default {
        components: {
            jsPDF, autoTable, Document, Paragraph, Packer, TextRun, saveAs, BorderStyle, WidthType, fs
        },
        props: {
            state: Object,
            map: Array,
            organization: Array,
            sociodemographic_contexts: Object,
            crime_contexts: Object,
            decisions: Array,
            indicators: Array,
        },
        
        data: () => ({
            mapImg: '',
            mapImgB64: '',
            orgImg: '',
            orgImgB64: '',
            sociodemographic_information_contexts: [
                {
                    id: 1,
                    variable_num: '1',
                    name: 'Población, 2017 (habitantes)',
                    national_avg: '3876304'
                },
                {
                    id: 2,
                    variable_num: '2',
                    name: 'Superficie (Km²)',
                    national_avg: '61474'
                },
                {
                    id: 3,
                    variable_num: '3',
                    name: 'Densidad de población, 2017 (habitantes/Km²)',
                    national_avg: '63'
                },
                {
                    id: 4,
                    variable_num: '4',
                    name: 'PIB, 2017 (millones de pesos a precios corrientes)',
                    national_avg: '765437'
                },
                {
                    id: 5,
                    variable_num: '5',
                    name: 'PIB per-cápita, 2017 (pesos a precios corrientes)',
                    national_avg: '197466'
                },
                {
                    id: 6,
                    variable_num: '6',
                    name: 'Promedio de escolaridad, 2015 (años)',
                    national_avg: '9.2'
                },
                {
                    id: 7,
                    variable_num: '7',
                    name: 'Porcentaje de población con carencia por acceso a servicios de salud, 2015',
                    national_avg: '16.9'
                },
                {
                    id: 8,
                    variable_num: '8',
                    name: 'Porcentaje de pobreza, 2016',
                    national_avg: '43.6'
                },
                {
                    id: 9,
                    variable_num: '9',
                    name: 'Índice de marginación, 2015',
                    national_avg: ''
                },
                {
                    id: 10,
                    variable_num: '9_s1',
                    name: 'Grado de marginación, 2015',
                    national_avg: ''
                }
            ],
            crime_information_contexts: [
                {
                    variable_num: 1,
                    name: 'Tasa de incidencia delictiva, 2018 (por cada cien mil habitantes)',
                    national_avg: '1483'
                },
                {
                    variable_num: 2,
                    name: 'Número de incidencia delictiva, 2018',
                    national_avg: '58071'
                },
                {
                    variable_num: 3,
                    name: 'Tasa de homicidio doloso, 2018 (por cada cien mil habitantes)',
                    national_avg: '23'
                },
                {
                    variable_num: 4,
                    name: 'Número de homicidios, 2018',
                    national_avg: '900'
                },
                {
                    variable_num: 5,
                    name: 'Tasa de robos, 2018 (por cada cien mil habitantes)',
                    national_avg: '573'
                },
                {
                    variable_num: 6,
                    name: 'Tasa de robos con violencia, 2018 (por cada cien mil habitantes)',
                    national_avg: '147'
                },
                {
                    variable_num: 7,
                    name: 'Tasa de robos sin violencia, 2018 (por cada cien mil habitantes)',
                    national_avg: '264'
                },
                {
                    variable_num: 8,
                    name: 'Número de robos, 2018',
                    national_avg: '22424'
                },
                {
                    variable_num: 9,
                    name: 'Número de robos con violencia, 2018',
                    national_avg: '5757'
                },
                {
                    variable_num: 10,
                    name: 'Número de robos sin violencia, 2018',
                    national_avg: '10338'
                },
                {
                    variable_num: 11,
                    name: 'Tasa de robos de vehículos, 2018 (por cada cien mil habitantes)',
                    national_avg: '161'
                },
                {
                    variable_num: 12,
                    name: 'Número de robos de vehículos',
                    national_avg: '6296'
                },
                {
                    variable_num: 13,
                    name: 'Porcentaje de mujeres (+15) con incidentes de violencia en el ámbito familiar, 2016',
                    national_avg: '10.3'
                },
                {
                    variable_num: 14,
                    name: 'Porcentaje de cifra negra con relación a los delitos ocurridos, 2017',
                    national_avg: '93.2'
                },
                {
                    variable_num: 15,
                    name: 'Porcentaje de población (18+) que percibe que su entidad federativa es segura, 2018',
                    national_avg: '19.0'
                },
                {
                    variable_num: 16,
                    name: 'Porcentaje de delitos no denunciados por causas atribuibles a la autoridad, 2017',
                    national_avg: '64.5'
                },
                {
                    variable_num: 17,
                    name: 'Porcentaje de población (18+) que identifica a los Ministerios Públicos y Procuradurías Estatales, en un nivel de algo de desconfianza y mucha desconfianza, 2018',
                    national_avg: '45.0'
                },
                {
                    variable_num: 18,
                    name: 'Porcentaje de población (18+) que percibe la existencia de corrupción en los Ministerios Públicos y Procuradurías Estatales, 2018',
                    national_avg: '66.5'
                },
                {
                    variable_num: 19,
                    name: 'Porcentaje de población (18+) que identifica a los Ministerios Públicos y Procuradurías Estatales, en un nivel de desempeño muy efectivo y algo efectivo, 2018',
                    national_avg: '50.0'
                },
            ]
        }),
        methods: {
            exportDocx() {
                let doc = new Document();

                let title = new Paragraph(`Reporte Detallado de ${this.state.name}`).title().center();
                doc.addParagraph(title);

                let context_information = new Paragraph(`Información de Contexto`).heading1().thematicBreak().center();
                doc.addParagraph(context_information);

                let sociodemographic_information = new Paragraph(`Información Sociodemográfica`).center().spacing({ before: 300, after: 300 });
                doc.addParagraph(sociodemographic_information);

                let sociodemographic_table = doc.createTable({
                    rows: 11,
                    columns: 4,
                    width: 100,
                    widthUnitType: WidthType.AUTO,
                    columnWidths: [4000, 1600, 1600, 1600],
                });
                sociodemographic_table.getCell(0, 0).addParagraph(new Paragraph("Información Sociodemográfica"));
                sociodemographic_table.getCell(0, 1).addParagraph(new Paragraph("Información del Estado"));
                sociodemographic_table.getCell(0, 2).addParagraph(new Paragraph("Promedio Nacional"));
                sociodemographic_table.getCell(0, 3).addParagraph(new Paragraph("Clasificación Estatal a Nivel Nacional"));

                for (let sd_context of this.$data.sociodemographic_information_contexts) {
                    sociodemographic_table.getCell(sd_context.id, 0).addParagraph(new Paragraph(sd_context.name));
                    sociodemographic_table.getCell(sd_context.id, 1).addParagraph(new Paragraph(this.$props.sociodemographic_contexts['variable'+sd_context.variable_num]));
                    sociodemographic_table.getCell(sd_context.id, 2).addParagraph(new Paragraph(sd_context.national_avg));
                    sociodemographic_table.getCell(sd_context.id, 3).addParagraph(new Paragraph(this.$props.sociodemographic_contexts['clasification'+sd_context.variable_num]));
                }

                let criminality_information = new Paragraph(`Información de Criminalidad`).center().spacing({ before: 500, after: 300 });
                doc.addParagraph(criminality_information);

                let criminality_table = doc.createTable({
                    rows: 20,
                    columns: 4,
                    width: 100,
                    widthUnitType: WidthType.AUTO,
                    columnWidths: [4000, 1600, 1600, 1600],
                });

                criminality_table.getCell(0, 0).addParagraph(new Paragraph("Información de Criminalidad"));
                criminality_table.getCell(0, 1).addParagraph(new Paragraph("Información del Estado"));
                criminality_table.getCell(0, 2).addParagraph(new Paragraph("Promedio Nacional"));
                criminality_table.getCell(0, 3).addParagraph(new Paragraph("Clasificación Estatal a Nivel Nacional"));

                for (let c_context of this.$data.crime_information_contexts) {
                    criminality_table.getCell(c_context.variable_num, 0).addParagraph(new Paragraph(c_context.name));
                    criminality_table.getCell(c_context.variable_num, 1).addParagraph(new Paragraph(this.$props.crime_contexts['variable'+c_context.variable_num]));
                    criminality_table.getCell(c_context.variable_num, 2).addParagraph(new Paragraph(c_context.national_avg));
                    criminality_table.getCell(c_context.variable_num, 3).addParagraph(new Paragraph(this.$props.crime_contexts['clasification'+c_context.variable_num]));
                }

                let map = new Paragraph(`Mapa del Estado`).center().spacing({ before: 500, after: 300 });
                doc.addParagraph(map);

                let map_bullet1 = new Paragraph("Sedes de la Fiscalía/Procuraduría").bullet();
                let map_bullet2 = new Paragraph("Municipios dentro de las sedes de la Fiscalía/Procuraduría").bullet();
                let map_bullet3 = new Paragraph("Número de Agentes del Ministerio Público por sede").bullet().spacing({ after: 300 });

                doc.addParagraph(map_bullet1);
                doc.addParagraph(map_bullet2);
                doc.addParagraph(map_bullet3);

                doc.createImage(this.mapImgB64, 600, 250, {

                });

                let headquarters_title = new Paragraph(`Sedes`).center().spacing({ before: 300, after: 300 });
                doc.addParagraph(headquarters_title);

                let headquarters_table = doc.createTable({
                    rows: this.$props.state.all_headquarters.length+1,
                    columns: 3,
                    width: 100,
                    widthUnitType: WidthType.AUTO,
                    columnWidths: [2934, 2934, 2934],
                });
                headquarters_table.getCell(0, 0).addParagraph(new Paragraph("Sede de la fiscalía"));
                headquarters_table.getCell(0, 1).addParagraph(new Paragraph("Municipios por sede"));
                headquarters_table.getCell(0, 2).addParagraph(new Paragraph("No. de agentes del ministerio público por sede"));

                for (let [index, headquarter] of this.$props.state.all_headquarters.entries()) {
                    headquarters_table.getCell(index+1, 0).addParagraph(new Paragraph(headquarter.name));
                    headquarters_table.getCell(index+1, 1).addParagraph(new Paragraph(headquarter.city_halls));
                    headquarters_table.getCell(index+1, 2).addParagraph(new Paragraph(headquarter.agents));
                }

                let organization = new Paragraph(`Estructura Organizacional`).center().spacing({ before: 500, after: 300 });
                doc.addParagraph(organization);

                doc.createImage(this.orgImgB64, 600, 250, {

                });

                let decision_analysis = new Paragraph(`Análisis de Decisiones`).heading1().thematicBreak().center();
                doc.addParagraph(decision_analysis);

                let ambits_decisions_table = [];
                let indicators_decision_table = [];

                for (let decision of this.$props.decisions) {
                    doc.addParagraph(new Paragraph(`Decisión ${decision.num}: ${decision.name}`).spacing({ before: 500, after: 300 }));

                    ambits_decisions_table[decision.num] = doc.createTable({
                        rows: 4,
                        columns: 3,
                        width: 100,
                        widthUnitType: WidthType.AUTO,
                        columnWidths: [4000, 1600, 1600, 1600],
                    });

                    ambits_decisions_table[decision.num].getCell(0, 0).addParagraph(new Paragraph("Ámbito"));
                    ambits_decisions_table[decision.num].getCell(0, 1).addParagraph(new Paragraph("Conclusión por Ámbito"));
                    ambits_decisions_table[decision.num].getCell(0, 2).addParagraph(new Paragraph("Posibles Problemáticas"));

                    ambits_decisions_table[decision.num].getCell(1, 0).addParagraph(new Paragraph("Regulatorio"));
                    ambits_decisions_table[decision.num].getCell(1, 1).addParagraph(new Paragraph(this.$props.state.conclusion[`conclusion-${decision.num}-1`]));
                    ambits_decisions_table[decision.num].getCell(1, 2).addParagraph(new Paragraph(this.$props.state.problematic[`problematic-${decision.num}-1`]));

                    ambits_decisions_table[decision.num].getCell(2, 0).addParagraph(new Paragraph("Institucional"));
                    ambits_decisions_table[decision.num].getCell(2, 1).addParagraph(new Paragraph(this.$props.state.conclusion[`conclusion-${decision.num}-2`]));
                    ambits_decisions_table[decision.num].getCell(2, 2).addParagraph(new Paragraph(this.$props.state.problematic[`problematic-${decision.num}-2`]));

                    ambits_decisions_table[decision.num].getCell(3, 0).addParagraph(new Paragraph("Individual"));
                    ambits_decisions_table[decision.num].getCell(3, 1).addParagraph(new Paragraph(this.$props.state.conclusion[`conclusion-${decision.num}-3`]));
                    ambits_decisions_table[decision.num].getCell(3, 2).addParagraph(new Paragraph(this.$props.state.problematic[`problematic-${decision.num}-3`]));

                    let indicator_title = new Paragraph(``).center().spacing({ before: 100, after: 100 });
                    doc.addParagraph(indicator_title);

                    indicators_decision_table[decision.num] = doc.createTable({
                        rows: ((this.$props.indicators.filter(indicator => indicator.decision_id == decision.id)).length)+1,
                        columns: 3,
                        width: 100,
                        widthUnitType: WidthType.AUTO,
                        columnWidths: [4000, 1600, 1600, 1600],
                    });

                    indicators_decision_table[decision.num].getCell(0, 0).addParagraph(new Paragraph("Indicator"));
                    indicators_decision_table[decision.num].getCell(0, 1).addParagraph(new Paragraph("Porcentaje"));
                    indicators_decision_table[decision.num].getCell(0, 2).addParagraph(new Paragraph("Interpretación"));

                    let decision_indicators = this.$props.indicators.filter(indicator => indicator.decision_id == decision.id);

                    for (let [index, indicator] of decision_indicators.entries()) {
                        indicators_decision_table[decision.num].getCell(index+1, 0).addParagraph(new Paragraph(indicator.name));
                        indicators_decision_table[decision.num].getCell(index+1, 1).addParagraph(new Paragraph(`${this.$options.filters.myNumberDecimal((this.$props.state.quantitative_source[indicator.dividend] / this.$props.state.quantitative_source[indicator.divider])*100)} %`));
                        indicators_decision_table[decision.num].getCell(index+1, 2).addParagraph(new Paragraph(this.$props.state.interpretation['interpretation'+indicator.id]));
                    }
                }

                let packer = new Packer();

                packer.toBlob(doc).then(blob => {
                    saveAs(blob, "detailed_report.docx");
                    console.log(this.mapImgB64);
                    
                    toast({
                        type: 'success',
                        title: '¡Documento generado exitosamente!'
                    })
                });
            },
            toDataURL(src, callback) {
                var image = new Image();
                image.crossOrigin = 'Anonymous';

                image.onload = function() {
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');
                    canvas.height = this.naturalHeight;
                    canvas.width = this.naturalWidth;
                    context.drawImage(this, 0, 0);
                    var dataURL = canvas.toDataURL('image/jpeg');
                    callback(dataURL);

                };

                image.src = src;
            },
            getMapImage(){
                if(this.$props.map.length > 0) {
                    this.mapImg = this.$props.map[0].path;
                    let mapURL = location.protocol + "//" + location.host +  '/' + 'myFiles' + '/' + this.mapImg;
                    
                    let vm = this;

                    this.toDataURL(mapURL, function(dataURL) {
                        // do something with dataURL
                        vm.mapImgB64 = dataURL
                    });
                }
            },
            getOrgChartImage(){
                if(this.$props.organization.length > 0) {
                    this.orgImg = this.$props.organization[0].path;
                    let orgURL = location.protocol + "//" + location.host +  '/' + 'myFiles' + '/' + this.orgImg;
                    
                    let vm = this;

                    this.toDataURL(orgURL, function(dataURL) {
                        // do something with dataURL
                        vm.orgImgB64 = dataURL
                    });
                }
            },
            exportPdf(){
                this.getMapImage();
                this.getOrgChartImage();
                var doc = new jsPDF();
                
                // doc.setDrawColor(0);
                // doc.setFillColor(244, 247, 252);
                // doc.rect(0, 0, 595.28,  841.89, 'F');
                doc.setFontSize(22);
                doc.setFontStyle("bold");
                doc.setTextColor(33,37,41);
                doc.text(`Reporte Detallado de ${this.$props.state.name}`, 105, 20, null, null, 'center');

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145,145,145);
                doc.text('INFORMACIÓN DE CONTEXTO', 105, 35 , null , null , 'center');

                doc.autoTable({
                    startY: 40,
                    html: '#sociodemographic',
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , textColor : [255 , 255 ,255]},
                    styles: {cellWidth: '100', cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 , textColor: [33,37,41]},
                                        columnStyles: {
                                    0: {cellWidth: 85},
                                    1: {cellWidth: 30},
                                    2: {cellWidth: 30},
                                    3: {cellWidth: 35}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });

                let finalY = doc.previousAutoTable.finalY;
                doc.autoTable({
                    startY: finalY + 15,
                    html: '#criminality',
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , textColor : [255 , 255 ,255]},
                    styles: {cellWidth: '100', cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 85},
                                    1: {cellWidth: 30},
                                    2: {cellWidth: 30},
                                    3: {cellWidth: 35}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });

                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Mapa Del Estado", 14, finalY + 15);

                if(this.mapImgB64) {
                    doc.addImage(this.mapImgB64, 15, finalY + 20, 126, 112);
                }

                doc.addPage();

                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Organigrama", 14, 15);

                if(this.orgImgB64) {
                    doc.addImage(this.orgImgB64, 15, 20, 126, 112);
                }

                doc.addPage();

                doc.setFontStyle("bold");
                doc.setFontSize(16);
                doc.setTextColor(145,145,145);
                doc.text("ANÁLISIS DE DECISIONES",105, 20 , 'center');

                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 1: Iniciar la investigación", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision1',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'} ,
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize:9 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;
                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision1',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();

                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 2: Ratificar detenciones en flagrancia", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision2',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });

                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision2',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();


                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 3: Ordenar la libertad de la persona detenida en flagrancia", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision3',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });
;

                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision3',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();


                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 4: Usar facultades para la terminación de la investigación", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision4',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision4',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 40 ,},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80, }
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();


                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 5: Dirigir la investigación", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision5',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision5',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();


                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 6: Resolver casos mediante acuerdo reparatorio en la investigación inicial", 14, 30);
                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision6',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision6',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();


                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 7: Solicitar audiencia inicial", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision7',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision7',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();


                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 8: Solicitar medidas cautelares", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision8',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision8',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();

                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 9: Resolver casos mediante acuerdo reparatorio en la investigación complementaria", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision9',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision9',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();

                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 10: Resolver casos mediante suspensión condicional del proceso", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision10',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision10',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();


                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 11: Resolver casos mediante procedimiento abreviado", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision11',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision11',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();

                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 12: Presentar la acusación", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision12',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 },
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });


                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision12',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                })
                doc.addPage();

                finalY = doc.previousAutoTable.finalY;
                doc.setFontSize(11);
                doc.setTextColor(74,74,74);
                doc.text("Decisión 13: Preparar la audiencia de juicio oral", 14, 30);

                doc.autoTable({
                    startY: 40,
                    html: '#conclusions-decision13',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8},
                    columnStyles: {
                                    0: {cellWidth: 24, valign: 'middle'},
                                    1: {cellWidth: 78},
                                    2: {cellWidth: 78}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                });

                finalY = doc.previousAutoTable.finalY;

                doc.autoTable({
                    startY: finalY + 15,
                    html: '#indicators-decision13',
                    pageBreak : 'avoid',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    cellWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize:9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize: 8 , minCellHeight:  7 , overflow : 'linebreak'},
                    columnStyles: {
                                    0: {cellWidth: 40},
                                    1: {cellWidth: 15 , valign: 'middle' , halign: 'center'},
                                    2: {cellWidth: 80}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15,
                }); 

                doc.save(`Detailed_Report_${this.$props.state.name}.pdf`);

            }
        },
        created(){
            this.getMapImage();
            this.getOrgChartImage();
        }
    }
</script>

<style lang="scss" scoped>

</style>