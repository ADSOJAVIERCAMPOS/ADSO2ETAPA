package co.sena.edu.agora.entity;

import jakarta.persistence.*;
import lombok.Data;

@Data
@Entity
@Table(name = "external_cases")
public class ExternalCase {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "external_case_id")
    private Long id;

    @OneToOne
    @JoinColumn(name = "case_id", nullable = false, unique = true)
    private Case caseEntity;

    @ManyToOne
    @JoinColumn(name = "relative_id", nullable = false)
    private Relative relative;

    @Column(name = "relative_contact")
    private String relativeContact;

    @Column(name = "relative_observation")
    private String relativeObservation;
}
