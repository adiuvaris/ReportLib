<?php
/*
 * //============================================================+
 * // File name     : example_017.php
 * // Version       : 1.0.0
 * // Last Update   : 20.12.22, 10:36
 * // Author        : Michael Hodel - reportlib.adiuvaris.ch - info@adiuvaris.ch
 * // License       : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
 * //
 * // Copyright (C) 2022 - 2022 Michael Hodel
 * //
 * // This file is part of ReportLib software library.
 * //
 * // ReportLib is free software: you can redistribute it and/or modify it
 * // under the terms of the GNU Lesser General Public License as
 * // published by the Free Software Foundation, either version 3 of the
 * // License, or (at your option) any later version.
 * //
 * // ReportLib is distributed in the hope that it will be useful, but
 * // WITHOUT ANY WARRANTY; without even the implied warranty of
 * // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * // See the GNU Lesser General Public License for more details.
 * //
 * // You should have received a copy of the GNU Lesser General Public License
 * // along with ReportLib.  If not, see <http://www.gnu.org/licenses/>.
 * //
 * // See LICENSE.TXT file for more information.
 * //============================================================+
 */

include_once "../src/Report.php";

use Adi\ReportLib as ReportLib;

// Create report instance
//  default format A4, portrait with margins left = 20mm, top = 10mm, right = 10mm and bottom = 10mm
$report = new ReportLib\Report();

// Get ref to the report body
$body = $report->getBody();

// Add the table
$table = $body->AddTable();
$table->setColumnLines(true);

// Add four columns to the table
$tcol = $table->addColumn("frametype", "Frame type", 40.0);
$tcol->setRightPen(new ReportLib\Pen(0.1, "#C0C0C0"));

$tcol = $table->addColumn("container", "Container type", 30.0, 'C');
$tcol->setRightPen(new ReportLib\Pen(0.1, "#C0C0C0"));

$tcol = $table->addColumn("description", "Description", 60.0);
$tcol->setRightPen(new ReportLib\Pen(0.1, "#C0C0C0"));
$table->addColumn("number", "Number", 20.0, 'R');

// The border just paints the top and bottom line, it is red an 0.3mm width
$border = new ReportLib\Border();
$border->setTopPen(new ReportLib\Pen(0.2, "#FF0000"));
$border->setBottomPen(new ReportLib\Pen(0.5, "#FF0000"));
$table->setBorder($border);

// Add a data row to the table with the column widths
$row = new ReportLib\TableRow('S');
$row->setText("frametype", "40mm width");
$row->setText("container", "30mm width");
$row->setText("description", "60mm width");
$row->setText("number", "20mm width");
$table->addDataRow($row);

// Add a data row to the table
$row = new ReportLib\TableRow('D');
$row->setText("frametype", "LineFrame");
$row->setText("container", "No");
$row->setText("description", "This frame type represents a line on the report.");
$row->setText("number", "1");
$table->addDataRow($row);

// Add a second data row to the table
$row = new ReportLib\TableRow('D');
$row->setText("frametype", "SerialFrame");
$row->setText("container", "Yes");
$row->setText("description", "This is a frame container for a series of frames which will be printed one after the other.");
$row->setText("number", "2");
$table->addDataRow($row);

// Add a third data row to the table
$row = new ReportLib\TableRow('D');
$row->setText("frametype", "TextFrame");
$row->setText("container", "No");
$row->setText("description", "A simple frame type to print text.");
$row->setText("number", "3");
$table->addDataRow($row);

// Add a total data row to the table
$row = new ReportLib\TableRow('T');
$row->setText("frametype", "Total");
$row->setText("container", "");
$row->setText("description", "");
$row->setText("number", "100.00");
$table->addDataRow($row);

// Produce the output of the report
//  uses the same params as TCPDF (F = File, I = Preview etc.)
$report->output(__DIR__ . "/example_017.pdf", 'I');

