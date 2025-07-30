package co.sena.edu.agora.entity;

import jakarta.persistence.*;
import lombok.Data;

import java.time.LocalDateTime;
import java.util.UUID;

@Data
@Entity
@Table(name = "cases")
public class Case {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "case_id")
    private Long id;

    @Column(name = "case_number", nullable = false, unique = true)
    private UUID caseNumber;

    @ManyToOne
    @JoinColumn(name = "apprentice_id", nullable = false)
    private Apprentice apprentice;

    @ManyToOne
    @JoinColumn(name = "category_id", nullable = false)
    private CaseCategory category;

    @ManyToOne
    @JoinColumn(name = "registered_by", nullable = false)
    private User registeredBy;

    @Column(name = "registered_at")
    private LocalDateTime registeredAt;

    @Column(name = "reason", nullable = false)
    private String reason;

    @Column(name = "observation")
    private String observation;

    @Column(name = "case_status")
    private String caseStatus;

    @Column(name = "resolution")
    private String resolution;

    @Column(name = "apprentice_signature")
    private byte[] apprenticeSignature;
}
