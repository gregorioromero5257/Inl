<template>
    <div class="col-md-12">
        <button class="btn btn-link float-right" @click="exportPdf">
            <i class="far fa-file-pdf"></i>
            {{ $t('executiveReport.generate_pdf') }}
        </button>
        <button class="btn btn-link float-right" @click="exportDocx">
            <i class="far fa-file-word"></i>
             {{ $t('executiveReport.generate_docx') }}
        </button>
    </div>
</template>

<script>
    import { WidthType, BorderStyle, Document, Paragraph, Packer, TextRun } from "docx";
    import * as fs from "fs";
    import { saveAs } from 'file-saver';
    import jsPDF from 'jspdf'
    import autoTable from 'jspdf-autotable'
    export default {
        components: {
            jsPDF, autoTable
        },
        props: {
            state: Object,
            criteria: Array,
        },
        
        data: () => ({

        }),
        methods: {
            exportDocx(){
                let doc = new Document();

                let title = new Paragraph(`Reporte Ejecutivo de ${this.state.name}`).title().center();
                doc.addParagraph(title);

                let regulatory = new Paragraph(`Ámbito Regulatorio`).heading1().thematicBreak().center();
                doc.addParagraph(regulatory);

                for (let [index, criterion] of this.$props.criteria.slice(0, 3).entries()) {
                    let regulatory_criterion = new Paragraph(`Criterio ${criterion.id}: ${criterion.name}`).spacing({ before: 300, after: 300 });
                    doc.addParagraph(regulatory_criterion);

                    let regulatory_problematic = new Paragraph(`${this.$props.state.criterion_problematic['problematicbycriterion'+criterion.id]}`).spacing({ before: 500, after: 300 });
                    doc.addParagraph(regulatory_problematic);
                }

                let institutional = new Paragraph(`Ámbito Institucional`).heading1().thematicBreak().center();
                doc.addParagraph(institutional);

                for (let [index, criterion] of this.$props.criteria.slice(3, 11).entries()) {
                    let institutional_criterion = new Paragraph(`Criterio ${criterion.id}: ${criterion.name}`).spacing({ before: 500, after: 300 });
                    doc.addParagraph(institutional_criterion);

                    let institutional_problematic = new Paragraph(`${this.$props.state.criterion_problematic['problematicbycriterion'+criterion.id]}`).spacing({ before: 500, after: 300 });
                    doc.addParagraph(institutional_problematic);
                }

                let individual = new Paragraph(`Ámbito Individual`).heading1().thematicBreak().center();
                doc.addParagraph(individual);

                for (let [index, criterion] of this.$props.criteria.slice(11, 15).entries()) {
                    let individual_criterion = new Paragraph(`Criterio ${criterion.id}: ${criterion.name}`).spacing({ before: 500, after: 300 });
                    doc.addParagraph(individual_criterion);

                    let individual_problematic = new Paragraph(`${this.$props.state.criterion_problematic['problematicbycriterion'+criterion.id]}`).spacing({ before: 500, after: 300 });
                    doc.addParagraph(individual_problematic);
                }

                let packer = new Packer();

                packer.toBlob(doc).then(blob => {
                    saveAs(blob, "executive_report.docx");
                    
                    toast({
                        type: 'success',
                        title: '¡Documento generado exitosamente!'
                    })
                });
            },
            exportPdf(){
                var doc = new jsPDF();

                doc.setFontSize(22);
                doc.setFontStyle("bold");
                doc.setTextColor(33,37,41);
                doc.text(`Reporte Ejecutivo de ${this.$props.state.name}`, 105, 20, null, null, 'center');

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145,145,145);
                doc.text('Ámbito Regulatorio', 105, 35 , null , null , 'center');

                doc.autoTable({
                    startY: 40,
                    html: '#criteria-regulatory',
                    showHead: 'firstPage',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    columnWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize: 9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize:8 },
                    columnStyles: {
                                    0: {columnWidth: 40},
                                    1: {columnWidth: 135},
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });

                doc.addPage();

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145,145,145);
                doc.text("Ámbito Intitucional", 85, 20 , null , null);

                doc.autoTable({
                    startY: 30,
                    html: '#criteria-institutional',
                    showHead: 'firstPage',
                    pageBreak : 'avoid',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    columnWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize: 9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize:8},
                    columnStyles: {
                                    0: {columnWidth: 40},
                                    1: {columnWidth: 135},
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });

                doc.addPage();

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145,145,145);
                doc.text("Ámbito Individual", 85, 20);

                doc.autoTable({
                    startY: 30,
                    html: '#criteria-individual',
                    showHead: 'firstPage',
                    rowPageBreak : 'avoid',
                    cellWidth : 'linebreak',
                    minCellHeight : 7,
                    columnWidth : 'wrap',
                    headStyles : {fillColor : [19 , 56 , 93], fontSize: 9 , valign: 'middle' , halign: 'center'},
                    styles: { cellPadding: 3, overflowColumns: 'linebreak' , fontSize:8 },
                    columnStyles: {
                                    0: {columnWidth: 40},
                                    1: {columnWidth: 135}
                                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });

                

                doc.save(`Executive_Report_${this.$props.state.name}.pdf`);
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>